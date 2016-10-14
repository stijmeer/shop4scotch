<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
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
        'parent_id'
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

    /*
     * Many-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return BelongsTo
     */
    public function parent_category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
