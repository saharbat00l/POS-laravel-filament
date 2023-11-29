<?php

namespace App\Filament\Resources\VendorLedgerResource\Pages;

use App\Filament\Resources\VendorLedgerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorLedgers extends ListRecords
{
    protected static string $resource = VendorLedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
