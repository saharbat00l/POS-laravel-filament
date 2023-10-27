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
use Filament\Infolists\Components\RepeatableEntry;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
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
            //     DateTimePicker::make('date')->required(),
            // Select::make('vendor_id')->required()->options($vendors),
            // RepeatableEntry::make('products')
            //     ->label('Products')
            //     ->recordActionLabel('Add Product')
            //     ->repeatables(
            //         RepeatableEntry::make('product')
            //             ->components([
            //                 TextInput::make('product_name')->label('Product')->required(),
            //                 TextInput::make('quantity')->label('Quantity')->required(),
            //                 TextInput::make('purchase_price')->label('Purchase Price')->required(),
            //             ])
            //     ),

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
                TextColumn::make('product.product_name.1')
                    ->searchable(),
                TextColumn::make('purchase_price.1')
                    ->searchable()
                    ->money('Rs.'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        ];
    }    
}
