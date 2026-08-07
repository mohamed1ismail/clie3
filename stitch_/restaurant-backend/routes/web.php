<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'East and West REST API Backend is running.',
        'documentation' => [
            'api_base' => '/api',
            'endpoints' => [
                'GET /api/dishes',
                'GET /api/categories',
                'GET /api/tables',
                'POST /api/orders',
                'POST /api/auth/login',
                'GET /api/admin/dashboard-stats'
            ]
        ]
    ]);
});
