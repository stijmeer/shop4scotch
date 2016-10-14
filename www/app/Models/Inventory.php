<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @link https://laravel.com/docs/5.2/eloquent#mass-assignment
     *
     * @var array
     */
    protected $fillable = [
        'stock',
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
}
