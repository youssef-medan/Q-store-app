<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class ShopingCart extends Model
{
    use HasFactory;
    // protected $guarded = [''];
    protected $fillable = [

        'id',
        'user_id',
        'product_id',
        'quantity',

    ];
    // public function users(){
    //     return $this->belongsTo(User::class);
    // }

    // public function product(){
    //     return $this->belongsToMany(Product::class);
    // }

}
