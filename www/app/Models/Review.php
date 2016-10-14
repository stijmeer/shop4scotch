<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
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
        'score',
    ];

    // Relationships
    // =============

    /*
     * Many-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-many
     *
     * @return BelongsTo
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
