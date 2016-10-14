<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
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
    public function address() : HasMany
    {
        return $this->hasMany(address::class);
    }
    public function region() : HasMany
    {
        return $this->hasMany(Region::class);
    }

    /*
     * Many-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return BelongsTo
     */
    public function shipment() : BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
