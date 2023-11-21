<?php

namespace App\Models;

use App\Models\Vendor;
use App\Models\PurchaseDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'vendor_id', 'product_id', 'quantity',
        'purchase_price'
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    // public function vendorDetails(): HasMany
    // {
    //     return $this->hasMany(Vendor::class, 'id', 'id');
    // }

    

}
