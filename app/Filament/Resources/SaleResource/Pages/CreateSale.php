<?php

namespace App\Filament\Resources\SaleResource\Pages;

use Filament\Actions;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\SaleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

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
               
               $sale_detail = [];
               $sale_detail['sale_id'] = $result->id;
               $sale_detail['product_id'] = $value['product'];
               $sale_detail['quantity'] = $value['quantity'];
               $sale_detail['scheme'] = $value['scheme'];
               $sale_detail['sale_price'] = $value['sale_price'];
               SaleDetail::create($sale_detail);

               $product_id = $value['product'];
               $quantity = $value['quantity'];
               $product = Product::find($product_id);
               $product->quantity = $product->quantity - $quantity;
               $product->save();
           }
       //  return true;   
           
       }
       //
       return $result;
   }

}