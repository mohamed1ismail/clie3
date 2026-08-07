<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            DishSeeder::class,
            TableSeeder::class,
            OfferSeeder::class,
            SocialLinkSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
