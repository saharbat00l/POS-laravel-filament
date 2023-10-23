<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Purchase;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PurchaseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PurchaseResource\RelationManagers;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DateTimePicker::make('purchase_date'),

                Select::make('vendors')
               ->preload()
               ->options(\App\Models\Vendor::all()->pluck('business_name', 'vendor_id')),


            //    ->relationship('vendors', 'business_name'),
            //     Select::make('products')
            //    ->preload()
            //    ->relationship('products', 'name'),
               
                Select::make('product_id')
                ->label('Product')
                ->options(\App\Models\Product::all()->pluck('name', 'product_id'))
                ->preload()
                ->required(),

               TextInput::make('quantity')
               ->required()
               ->maxLength(255),
               TextInput::make('purchase_price')
               ->required()
               ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('purchase_date')
                    ->dateTime('d-M-Y')->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('vendors.business_name')
                ->searchable(),
                TextColumn::make('products')
                ->searchable(),
                TextColumn::make('quantity')
                ->searchable(),
                TextColumn::make('purchase_price')
                ->searchable(),
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
