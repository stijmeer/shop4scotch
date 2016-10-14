<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class BasketStatus extends Model
{
    public $timestamps = false;

    // Relationships
    // =============

    /*
     * One-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return hasMany
     */
    public function basket() : HasMany
    {
        return $this->hasMany(Basket::class);
    }

}
