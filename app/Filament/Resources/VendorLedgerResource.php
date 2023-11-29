<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorLedgerResource\Pages;
use App\Filament\Resources\VendorLedgerResource\RelationManagers;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorLedgerResource extends Resource
{
    protected static ?string $navigationGroup = 'Ledgers';

    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function getNavigationBadge(): ?string
    {
        return Vendor::count();
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
                ->url(fn (Vendor $ledger) => route('ledgervendor', ['id' => $ledger->id]))
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
            'index' => Pages\ListVendorLedgers::route('/'),
            'create' => Pages\CreateVendorLedger::route('/create'),
            'edit' => Pages\EditVendorLedger::route('/{record}/edit'),
        ];
    }    
}
