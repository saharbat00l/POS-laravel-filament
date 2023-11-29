<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CustomerLedger;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerLedgerResource\Pages;
use App\Filament\Resources\CustomerLedgerResource\RelationManagers;

class CustomerLedgerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $navigationGroup = 'Ledgers';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    public static function getNavigationBadge(): ?string
    {
        return Customer::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('business_name')->sortable()->searchable(),
            // Tables\Columns\TextColumn::make('contact1')->sortable()->searchable(),
            // Tables\Columns\TextColumn::make('address1')->sortable()->searchable(),
            // Tables\Columns\TextColumn::make('business_email')->sortable()->searchable(),
        ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Get Ledger')
                // ->icon('heroicon-o-document-download')
                ->url(fn (Customer $ledger) => route('ledgercustomer', ['id' => $ledger->id]))
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
            'index' => Pages\ListCustomerLedgers::route('/'),
            'create' => Pages\CreateCustomerLedger::route('/create'),
            'edit' => Pages\EditCustomerLedger::route('/{record}/edit'),
        ];
    }    
}
