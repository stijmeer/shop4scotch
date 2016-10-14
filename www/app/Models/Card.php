<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @link https://laravel.com/docs/5.2/eloquent#mass-assignment
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'name',
        'expiration_date',
    ];

    // Relationships
    // =============

    // Relationships
    // =============

    /*
     * One-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-one
     *
     * @return HasOne
     */
    public function card_code() : HasOne
    {
        return $this->hasOne(CardCode::class);
    }

    /*
     * Many-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#many-to-many
     *
     * @return BelongsToMany
     */
    public function user() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function card_types() : BelongsToMany
    {
        return $this->belongsToMany(CardType::class);
    }
}
