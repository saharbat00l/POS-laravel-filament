<?php

namespace App\Filament\Resources\VendorResource\Pages;

use App\Filament\Resources\VendorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateVendor extends CreateRecord
{
    protected static string $resource = VendorResource::class;
    protected function getRedirectUrl(): string
   {
    return $this->getResource()::getUrl('index');
   }

//    protected function handleRecordCreation(array $data): Model
// 	{
// 	    $result = static::getModel()::create($data);
// 	    $record_id = $result->id;
// 	}
}
