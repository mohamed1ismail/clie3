<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'sort_order' => $this->sort_order,
            'is_active' => (bool) $this->is_active,
            'dishes_count' => $this->whenCounted('dishes'),
            'dishes' => DishResource::collection($this->whenLoaded('dishes')),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
