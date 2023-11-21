<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vendor;
use App\Models\Purchase;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PurchaseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Product;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Tables\Columns\Summarizers\Sum;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    public static function getNavigationBadge(): ?string
    {
        return Purchase::count();
    }

    public static function form(Form $form): Form
    {
        $vendors = Vendor::orderBy('business_name','asc')->get()->pluck('business_name','id');
        $products = Product::orderBy('product_name','asc')->get()->pluck('product_name','id');



        return $form
            ->schema([
                DateTimePicker::make('date')->required(),
                Select::make('vendor_id')->required()->options($vendors),
                // TextInput::make('purchase_price')->required(),


                Repeater::make('products')
                ->schema([
                    Select::make('product')->required()->options($products),
                    TextInput::make('quantity')->required(),
                    TextInput::make('purchase_price')->required(),
                ])->columns(3)->columnSpanFull()

            ]); //schema
    } //fucntion

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->searchable(),
                TextColumn::make('vendor.business_name')
                ->searchable(),
                TextColumn::make('purchaseDetails.product.product_name'),
                TextColumn::make('purchaseDetails.purchase_price')
                ->formatStateUsing(fn (string $state): string => __('Rs '.array_sum(explode(',', $state))))

                

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Get Invoice')
                // ->icon('heroicon-o-document-download')
                // ->url(fn (Student $record) => route('student.pdf.download', $record))
                ->openUrlInNewTab(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
            // 'invoice' => Pages\Invoice::route('/{record}/invoice'),
        ];
    }    
}
