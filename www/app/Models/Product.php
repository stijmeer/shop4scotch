<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
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
        'name',
        'description',
        'stock',
        'price',
        'volume',
        'age',
        'color',
        'smell',
        'taste',
        'alcohol_percentage',
        'packaging',
        'suggestion_id',
        'distillery_id',
        'tax_id',
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
    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function price() : HasMany
    {
        return $this->hasMany(Price::class);
    }
    public function inventory() : HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    /*
     * Many-to-Many
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#many-to-many
     *
     * @return BelongsToMany
     */
    public function order() : BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price', 'price_discount')
            ->withTimestamps();
    }
    public function basket() : BelongsToMany
    {
        return $this->belongsToMany(Basket::class)
            ->withPivot('amount')
            ->withTimestamps();
    }
    public function category() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function wishlist() : BelongsToMany
    {
        return $this->belongsToMany(Wishlist::class);
    }
    public function promotion() : BelongsToMany
    {
        return $this->belongsToMany(Promotion::class);
    }

    /*
     * Many-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return BelongsTo
     */
    public function distillery() : BelongsTo
    {
        return $this->belongsTo(Distillery::class);
    }
    public function tax() : BelongsTo
    {
        return $this->belongsTo(Tax::class);
    }
    public function suggestion() : BelongsTo
    {
        return $this->belongsTo(Suggestion::class);
    }
}
