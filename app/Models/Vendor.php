<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable= [
        'business_name', 'parent_id', 'person_name', 'address1', 'address2',
        'contact1', 'contact2', 'business_email', 'personal_email', 
        'description'
    ];




    public function parent(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Vendor::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
    
}
