<?php

namespace App\Models;

use App\user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Basket extends Model
{
    use SoftDeletes;

    // Relationships
    // =============

    /*
     * One-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-one
     *
     * @return HasOne
     */
    public function user() : HasOne
    {
        return $this->hasOne(user::class);
    }

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
    public function basket_status() : BelongsTo
    {
        return $this->belongsTo(BasketStatus::class);
    }
}
