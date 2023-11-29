<?php

namespace App\Filament\Resources\CustomerLedgerResource\Pages;

use App\Filament\Resources\CustomerLedgerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerLedger extends CreateRecord
{
    protected static string $resource = CustomerLedgerResource::class;
}
