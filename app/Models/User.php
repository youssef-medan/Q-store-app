<?php
namespace App\Models;

use App\Models\Scopes\LastestScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject , MustVerifyEmail
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',
        'email',
        'password',
        'mobile',
        'role',
        'email_verified_at',
    ];

    protected $appends = ['registered'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    // public function products(){
    //     return $this->hasMany(Product::class);

    // }

    // protected static function booted(): void
    // {
    //     static::addGlobalScope(new LastestScope);

    // }

    // public function scopeLastest(Builder $query): void
    // {
    //     $query->orderBy('created_at', 'asc');
    // }
    public function shopingCartProducts()
    {
        return $this->belongsToMany(Product::class, 'shoping_carts', 'user_id', 'product_id')->withPivot('id','quantity');
    }
    // public function shopingcart(){
    //     return $this->hasOne(ShopingCart::class);
    // }

    public function sellproducts() {
        return $this->hasMany(Product::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }





    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function getRegisteredAttribute(){
        return $this->created_at->diffForHumans();
    }
}
