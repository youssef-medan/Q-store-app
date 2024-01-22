<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [''];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function sub_categories()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
    public function category_image(){
        return $this->hasOne(CategoryImage::class);
    }

    public function main_category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    use HasFactory;
}
