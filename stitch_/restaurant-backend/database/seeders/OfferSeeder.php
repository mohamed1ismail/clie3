<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            [
                'title' => 'Chef Happy Hour Special',
                'description' => 'Get 20% off all main courses and craft beverages every weekday between 4 PM and 7 PM.',
                'discount_percentage' => 20.00,
                'discount_amount' => null,
                'code' => 'HAPPY20',
                'banner_image_path' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200',
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'title' => 'Weekend Gourmet Pairing',
                'description' => 'Complimentary artisanal dessert with any Wagyu or Lobster entree order.',
                'discount_percentage' => null,
                'discount_amount' => 12.00,
                'code' => 'SWEETWEEKEND',
                'banner_image_path' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=1200',
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'is_active' => true,
            ],
        ];

        foreach ($offers as $offer) {
            Offer::updateOrCreate(['title' => $offer['title']], $offer);
        }
    }
}
