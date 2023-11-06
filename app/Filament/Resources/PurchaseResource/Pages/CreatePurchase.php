<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use Filament\Actions;
use App\Models\Product;
use App\Models\PurchaseDetail;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PurchaseResource;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;
    protected function getRedirectUrl(): string
   {
    return $this->getResource()::getUrl('index');
   }

   protected function handleRecordCreation(array $data): Model
	{

	    $result = static::getModel()::create($data);
        // dd($data['products']);
        if(!empty($data['products'])){
            foreach ($data['products'] as $key => $value) {
                
                $purchase_detail = [];
                $purchase_detail['purchase_id'] = $result->id;
                $purchase_detail['product_id'] = $value['product'];
                $purchase_detail['quantity'] = $value['quantity'];
                $purchase_detail['purchase_price'] = $value['purchase_price'];
                PurchaseDetail::create($purchase_detail);

                
                $product_id = $value['product'];
                $quantity = $value['quantity'];
                $product = Product::find($product_id);
                $product->quantity = $product->quantity + $quantity;
                $product->save();
            
            }
        //  return true;   
            
        }
	    //
 
        return $result;
	}


   
}
