<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suggestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @link https://laravel.com/docs/5.2/eloquent#mass-assignment
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
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
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
