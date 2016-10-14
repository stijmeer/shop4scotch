<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @link https://laravel.com/docs/5.2/eloquent#mass-assignment
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'type',
        'discount',
        'required_amount',
        'legal',
        'start',
        'end',
    ];

    // Relationships
    // =============

    /*
     * Many-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#many-to-many
     *
     * @return BelongsToMany
     */
    public function product() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
