<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\JsonResponse;

class DashboardStatsController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $activeOrders = Order::whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])->count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        
        $totalTables = Table::count();
        $occupiedTables = Table::where('status', 'occupied')->count();
        $availableTables = Table::where('status', 'available')->count();
        
        $totalDishes = Dish::count();
        $availableDishes = Dish::where('is_available', true)->count();

        $recentOrders = Order::with(['table', 'items'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'stats' => [
                'total_orders' => $totalOrders,
                'pending_orders' => $pendingOrders,
                'active_orders' => $activeOrders,
                'completed_orders' => $completedOrders,
                'total_revenue' => (float) $totalRevenue,
                'total_tables' => $totalTables,
                'occupied_tables' => $occupiedTables,
                'available_tables' => $availableTables,
                'total_dishes' => $totalDishes,
                'available_dishes' => $availableDishes,
            ],
            'recent_orders' => $recentOrders,
        ]);
    }
}
