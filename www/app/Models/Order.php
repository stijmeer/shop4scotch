<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use SoftDeletes;

    // Relationships
    // =============

    /*
     * Many-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#many-to-many
     *
     * @return BelongsToMany
     */
    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /*
     * Many-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return BelongsTo
     */
    public function billing_address() : BelongsTo
    {
        return $this->belongsTo(address::class, 'address_Billing_ID');
    }
    public function delivery_address() : BelongsTo
    {
        return $this->belongsTo(address::class, 'address_Delivery_ID');
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function order_status() : BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
