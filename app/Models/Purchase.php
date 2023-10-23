<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_date',
        'vendor_id',
        'product_id',
        'quantity',
        'purchase_price',
    ];


    protected $primaryKey = 'purchase_id, product_id';



    public function products():BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function vendors():BelongsTo {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
