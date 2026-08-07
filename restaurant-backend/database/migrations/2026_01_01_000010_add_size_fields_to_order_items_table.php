<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Nullable FK — set null if the size record is deleted later
            $table->foreignId('dish_size_id')
                ->nullable()
                ->after('dish_id')
                ->constrained('dish_sizes')
                ->onDelete('set null');

            // Denormalised text snapshot — preserves historical order data
            // even if the DishSize record is later deleted
            $table->string('size_name')->nullable()->after('dish_size_id');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('dish_size_id');
            $table->dropColumn('size_name');
        });
    }
};
