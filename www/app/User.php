<?php

namespace App;

use App\Models\address;
use App\Models\Basket;
use App\Models\Card;
use App\Models\Order;
use App\Models\Review;
use App\Models\Wishlist;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender',
        'name_first',
        'name_second',
        'name_last',
        'date_birth',
        'email',
        'phone_mobile',
        'phone_landline',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    // =============

    /*
     * One-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-one
     *
     * @return HasOne
     */
    public function basket() : HasOne
    {
        return $this->hasOne(Basket::class);
    }

    /*
     * One-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return HasMany
     */
    public function address() : HasMany
    {
        return $this->hasMany(address::class);
    }
    public function card() : HasMany
    {
        return $this->hasMany(Card::class);
    }
    public function order() : HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function review() : HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function wishlist() : HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
    
}
