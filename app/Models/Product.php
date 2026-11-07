<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'description',
        'image',
        'old_price',
        'new_price',
    ];

    // Product belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product belongs to Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function products()
{
    return $this->hasMany(Product::class);
}
}