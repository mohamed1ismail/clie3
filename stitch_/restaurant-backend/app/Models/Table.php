<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Table extends Model
{
    protected $fillable = [
        'table_number',
        'capacity',
        'status',
        'qrcode_path',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    protected $appends = ['qrcode_url'];

    public function getQrcodeUrlAttribute(): ?string
    {
        if (!$this->qrcode_path) {
            return url("/api/tables/{$this->id}/qrcode");
        }
        if (str_starts_with($this->qrcode_path, 'http://') || str_starts_with($this->qrcode_path, 'https://')) {
            return $this->qrcode_path;
        }
        return Storage::disk('public')->url($this->qrcode_path);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
