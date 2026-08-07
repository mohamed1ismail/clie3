<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DishSize extends Model
{
    protected $fillable = [
        'dish_id',
        'size_name',
        'price',
        'is_default',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'is_default' => 'boolean',
    ];

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}
