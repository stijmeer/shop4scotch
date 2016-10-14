<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class CardType extends Model
{
    // Relationships
    // =============

    /*
     * One-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return hasMany
     */
    public function card() : HasMany
    {
        return $this->hasMany(Card::class);
    }
}
