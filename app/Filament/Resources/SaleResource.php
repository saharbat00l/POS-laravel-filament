<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Sale;
use Filament\Tables;
use App\Models\Product;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\SaleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SaleResource\RelationManagers;
use Faker\Provider\ar_EG\Text;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationBadge(): ?string
    {
        return Sale::count();
    }

    public static function form(Form $form): Form
    {
        // $vendors = Vendor::orderBy('business_name','asc')->get()->pluck('business_name','id');
        $products = Product::orderBy('product_name','asc')->get()->pluck('product_name','id');
        $customers = Customer::orderBy('business_name','asc')->get()->pluck('business_name','id');
        return $form
            ->schema([
                DateTimePicker::make('date')->required(),
                Select::make('customer_id')->required()->options($customers),
                // TextInput::make('purchase_price')->required(),


                Repeater::make('products')
                ->schema([
                    Select::make('product')->required()->options($products),
                    TextInput::make('quantity')->required(),
                    TextInput::make('scheme')->required(),
                    TextInput::make('sale_price')->required(),
                ])->columns(3)->columnSpanFull()
           
           
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->searchable(),
                TextColumn::make('customer.business_name')
                    ->searchable(),
                TextColumn::make('sale_price')
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }    
}
