<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_date',
        'vendors',
        'products',
        'quantity',
    ];
    public function vendors()
    {
        return $this->belongsTo(Vendor::class);
    }
}
