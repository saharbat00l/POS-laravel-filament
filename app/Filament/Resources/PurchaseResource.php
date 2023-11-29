<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Purchase;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PurchaseResource\Pages;
use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PurchaseResource\RelationManagers;

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
                DatePicker::make('date')->required()->default(now()),
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
                ->url(fn (Purchase $purchase) => route('get-pdf', ['id' => $purchase->id]))
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
