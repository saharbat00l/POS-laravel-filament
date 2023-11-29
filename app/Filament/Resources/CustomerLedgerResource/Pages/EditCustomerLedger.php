<?php

namespace App\Filament\Resources\CustomerLedgerResource\Pages;

use App\Filament\Resources\CustomerLedgerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerLedger extends EditRecord
{
    protected static string $resource = CustomerLedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
