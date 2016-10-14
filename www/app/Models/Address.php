<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class address extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @link https://laravel.com/docs/5.2/eloquent#mass-assignment
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'number',
        'bus',
        'postalcode',
        'city',
        'state_or_province',
        'type',
];

    // Relationships
    // =============

    /*
     * One-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return hasMany
     */
    public function order_billing() : HasMany
    {
        return $this->hasMany(Order::class, 'address_Billing_ID');
    }
    public function order_delivery() : HasMany
    {
        return $this->hasMany(Order::class, 'address_Delivery_ID');
    }

    /*
     * Many-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return BelongsTo
     */
    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
