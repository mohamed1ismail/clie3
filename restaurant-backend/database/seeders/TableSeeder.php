<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $capacity = ($i % 4 === 0) ? 6 : (($i % 2 === 0) ? 4 : 2);
            $status = ($i === 3 || $i === 7 || $i === 12) ? 'occupied' : 'available';

            Table::updateOrCreate(
                ['table_number' => "Table {$i}"],
                [
                    'capacity' => $capacity,
                    'status' => $status,
                    'qrcode_path' => null,
                ]
            );
        }
    }
}
