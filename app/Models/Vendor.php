<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'person_name',
        'address1',
        'address2',
        'contact1',
        'contact2',
        'description',
    ];

    protected $primaryKey = 'vendor_id';

}
