<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Offer::query();

        if ($request->boolean('active_only', false) || !$request->user()) {
            $query->where('is_active', true);
        }

        $offers = $query->orderBy('created_at', 'desc')->get();

        return OfferResource::collection($offers);
    }

    public function show(Offer $offer): OfferResource
    {
        return new OfferResource($offer);
    }

    public function store(StoreOfferRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('offers', 'public');
            $data['banner_image_path'] = $path;
        }

        $offer = Offer::create($data);

        return response()->json([
            'message' => 'Offer created successfully',
            'data' => new OfferResource($offer),
        ], 201);
    }

    public function update(UpdateOfferRequest $request, Offer $offer): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('offers', 'public');
            $data['banner_image_path'] = $path;
        }

        $offer->update($data);

        return response()->json([
            'message' => 'Offer updated successfully',
            'data' => new OfferResource($offer),
        ]);
    }

    public function destroy(Offer $offer): JsonResponse
    {
        $offer->delete();

        return response()->json([
            'message' => 'Offer deleted successfully',
        ]);
    }
}
