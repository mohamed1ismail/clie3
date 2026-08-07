<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $tables = Table::orderBy('table_number', 'asc')->get();
        return TableResource::collection($tables);
    }

    public function show(Table $table): TableResource
    {
        return new TableResource($table);
    }

    public function store(StoreTableRequest $request): JsonResponse
    {
        $table = Table::create($request->validated());

        return response()->json([
            'message' => 'Table created successfully',
            'data' => new TableResource($table),
        ], 201);
    }

    public function update(UpdateTableRequest $request, Table $table): JsonResponse
    {
        $table->update($request->validated());

        return response()->json([
            'message' => 'Table updated successfully',
            'data' => new TableResource($table),
        ]);
    }

    public function destroy(Table $table): JsonResponse
    {
        $table->delete();

        return response()->json([
            'message' => 'Table deleted successfully',
        ]);
    }

    public function qrcode(Table $table, Request $request)
    {
        $targetUrl = config('app.url') . "/menu?table=" . $table->table_number;
        
        $format = $request->query('format', 'svg');

        if ($format === 'png') {
            $qrCode = QrCode::format('png')->size(300)->margin(2)->generate($targetUrl);
            return response($qrCode, 200)->header('Content-Type', 'image/png');
        }

        $qrCode = QrCode::format('svg')->size(300)->margin(2)->generate($targetUrl);
        return response($qrCode, 200)->header('Content-Type', 'image/svg+xml');
    }
}
