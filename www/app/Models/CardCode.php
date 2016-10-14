<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardCode extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @link https://laravel.com/docs/5.2/eloquent-serialization#hiding-attributes-from-json
     *
     * @var array
     */
    protected $hidden = [
        'cvc_cid',
    ];
    
    // Relationships
    // =============

    /*
     * One-to-One
     *
     * @link https://laravel.com/docs/5.2/eloquent-relationships#one-to-one
     *
     * @return HasOne
     */
    public function card() : HasOne
    {
        return $this->hasOne(Card::class);
    }
}
