<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    // public function shoping_carts(){
    //     return $this->hasMany(ShopingCart::class);
    // }

    // public function users(){
    //     return $this->belongsToMany(User::class);

    // }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'shoping_carts', 'product_id', 'user_id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function reviews(){
        return $this->hasMany(Review::class);

    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function image(){
        return $this->hasOne(Image::class);
    }

}
