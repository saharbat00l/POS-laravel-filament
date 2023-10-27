<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =[
        'business_name', 'person_name', 'address1', 'address2',
        'contact1', 'contact2', 'business_email', 'personal_email', 
        'referred_by', 'description'
    ];


    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
    
}
