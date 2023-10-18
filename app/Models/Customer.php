<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'customer_name',
        'address1',
        'address2',
        'contact1',
        'contact2',
        'ref_name',
        'ref_number',

    ];
}
