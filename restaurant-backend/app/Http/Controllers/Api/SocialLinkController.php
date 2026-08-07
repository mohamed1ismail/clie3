<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSocialLinksRequest;
use App\Http\Resources\SocialLinkResource;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SocialLinkController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $links = SocialLink::orderBy('sort_order', 'asc')->get();
        return SocialLinkResource::collection($links);
    }

    public function update(UpdateSocialLinksRequest $request): JsonResponse
    {
        $validated = $request->validated();

        foreach ($validated['links'] as $item) {
            SocialLink::updateOrCreate(
                ['platform' => $item['platform']],
                [
                    'title' => $item['title'],
                    'url' => $item['url'],
                    'icon' => $item['icon'] ?? null,
                    'is_active' => $item['is_active'] ?? true,
                    'sort_order' => $item['sort_order'] ?? 0,
                ]
            );
        }

        $links = SocialLink::orderBy('sort_order', 'asc')->get();

        return response()->json([
            'message' => 'Social links updated successfully',
            'data' => SocialLinkResource::collection($links),
        ]);
    }
}
