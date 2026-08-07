<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $table3 = Table::where('table_number', 'Table 3')->first();
        $table7 = Table::where('table_number', 'Table 7')->first();

        $truffle = Dish::where('slug', 'truffle-arancini-balls')->first();
        $wagyu = Dish::where('slug', 'wagyu-ribeye-steak')->first();
        $lava = Dish::where('slug', 'molten-chocolate-lava-cake')->first();

        if ($table3 && $truffle && $wagyu) {
            $order1 = Order::updateOrCreate(
                ['order_number' => 'ORD-SEED-001'],
                [
                    'table_id' => $table3->id,
                    'customer_name' => 'Alice Smith',
                    'customer_phone' => '+15550192',
                    'status' => 'preparing',
                    'total_amount' => 62.50,
                    'payment_status' => 'pending',
                    'notes' => 'Steak cooked medium-rare please.',
                ]
            );

            $order1->items()->createMany([
                [
                    'dish_id' => $truffle->id,
                    'dish_name' => $truffle->name,
                    'unit_price' => $truffle->price,
                    'quantity' => 1,
                    'subtotal' => $truffle->price,
                ],
                [
                    'dish_id' => $wagyu->id,
                    'dish_name' => $wagyu->name,
                    'unit_price' => $wagyu->price,
                    'quantity' => 1,
                    'subtotal' => $wagyu->price,
                ],
            ]);
        }

        if ($table7 && $lava) {
            $order2 = Order::updateOrCreate(
                ['order_number' => 'ORD-SEED-002'],
                [
                    'table_id' => $table7->id,
                    'customer_name' => 'Bob Jones',
                    'customer_phone' => '+15550199',
                    'status' => 'completed',
                    'total_amount' => 12.00,
                    'payment_status' => 'paid',
                    'notes' => null,
                ]
            );

            $order2->items()->create([
                'dish_id' => $lava->id,
                'dish_name' => $lava->name,
                'unit_price' => $lava->price,
                'quantity' => 1,
                'subtotal' => $lava->price,
            ]);
        }
    }
}
