<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
    
    public function images()
    {
        return $this->hasMany(\App\Models\ProductImage::class);
    }


}
