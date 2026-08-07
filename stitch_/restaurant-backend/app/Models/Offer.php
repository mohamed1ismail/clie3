<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'description',
        'discount_percentage',
        'discount_amount',
        'code',
        'banner_image_path',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected $appends = ['banner_image_url'];

    public function getBannerImageUrlAttribute(): ?string
    {
        if (!$this->banner_image_path) {
            return null;
        }
        if (str_starts_with($this->banner_image_path, 'http://') || str_starts_with($this->banner_image_path, 'https://')) {
            return $this->banner_image_path;
        }
        return Storage::disk('public')->url($this->banner_image_path);
    }
}
