<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitOrderRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Dish;
use App\Models\DishSize;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Order::query()->with(['table', 'items']);

        if ($request->filled('since')) {
            $since = $request->input('since');
            if (is_numeric($since)) {
                $query->where('updated_at', '>=', date('Y-m-d H:i:s', (int) $since));
            } else {
                $query->where('updated_at', '>=', $since);
            }
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('table_id')) {
            $query->where('table_id', $request->input('table_id'));
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return OrderResource::collection($orders);
    }

    public function show(Order $order): OrderResource
    {
        $order->load(['table', 'items']);
        return new OrderResource($order);
    }

    public function store(SubmitOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(4));

            $totalAmount = 0;
            $itemsData   = [];

            foreach ($validated['items'] as $item) {
                $dish = Dish::findOrFail($item['dish_id']);

                // -----------------------------------------------------------------
                // Resolve unit price: prefer the chosen size's price over the
                // dish's base price. Also validate that the size actually belongs
                // to this dish (prevents ordering a size from a different dish).
                // -----------------------------------------------------------------
                $dishSizeId = $item['dish_size_id'] ?? null;
                $sizeName   = null;
                $unitPrice  = (float) $dish->price;

                if ($dishSizeId) {
                    /** @var DishSize|null $size */
                    $size = DishSize::find($dishSizeId);

                    if ($size && (int) $size->dish_id === (int) $dish->id) {
                        $unitPrice  = (float) $size->price;
                        $sizeName   = $size->size_name;
                    } else {
                        // Mismatched size — abort with a validation-style error
                        abort(422, "dish_size_id {$dishSizeId} does not belong to dish {$dish->id}");
                    }
                }

                $subtotal     = $unitPrice * (int) $item['quantity'];
                $totalAmount += $subtotal;

                $itemsData[] = [
                    'dish_id'              => $dish->id,
                    'dish_size_id'         => $dishSizeId,     // nullable FK
                    'dish_name'            => $dish->name,
                    'size_name'            => $sizeName,        // text snapshot
                    'unit_price'           => $unitPrice,
                    'quantity'             => $item['quantity'],
                    'subtotal'             => $subtotal,
                    'special_instructions' => $item['special_instructions'] ?? null,
                ];
            }

            $order = Order::create([
                'order_number'   => $orderNumber,
                'table_id'       => $validated['table_id']       ?? null,
                'customer_name'  => $validated['customer_name']  ?? 'Guest',
                'customer_phone' => $validated['customer_phone'] ?? null,
                'notes'          => $validated['notes']          ?? null,
                'total_amount'   => $totalAmount,
                'status'         => 'pending',
                'payment_status' => 'pending',
            ]);

            foreach ($itemsData as $item) {
                $order->items()->create($item);
            }

            return $order;
        });

        $order->load(['table', 'items']);

        return response()->json([
            'message' => 'Order submitted successfully',
            'data'    => new OrderResource($order),
        ], 201);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order): JsonResponse
    {
        $validated = $request->validated();
        $order->update($validated);
        $order->load(['table', 'items']);

        return response()->json([
            'message' => 'Order status updated successfully',
            'data'    => new OrderResource($order),
        ]);
    }
}
