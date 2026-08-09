<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('dishes')
            ->whereNull('name_ar')
            ->orWhere('name_ar', '')
            ->update([
                'name_ar' => DB::raw('name'),
            ]);

        DB::table('dishes')
            ->whereNull('name_en')
            ->orWhere('name_en', '')
            ->update([
                'name_en' => DB::raw('name'),
            ]);

        DB::table('dishes')
            ->whereNull('description_ar')
            ->orWhere('description_ar', '')
            ->update([
                'description_ar' => DB::raw('description'),
            ]);

        DB::table('dishes')
            ->whereNull('description_en')
            ->orWhere('description_en', '')
            ->update([
                'description_en' => DB::raw('description'),
            ]);
    }

    public function down(): void
    {
        // No-op: historical backfill is not reversible because the original data may already be overwritten.
    }
};
