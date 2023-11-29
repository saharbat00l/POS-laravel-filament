<?php

namespace App\Filament\Resources\CustomerLedgerResource\Pages;

use App\Filament\Resources\CustomerLedgerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerLedgers extends ListRecords
{
    protected static string $resource = CustomerLedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
