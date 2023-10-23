<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_date',
        'customer',
        'product',
        'quantity',
        'sale_price',
        'scheme',
    ];

    
}
