<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'platform' => 'instagram',
                'title' => 'Instagram',
                'url' => 'https://instagram.com/restaurant_gourmet',
                'icon' => 'instagram',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'platform' => 'facebook',
                'title' => 'Facebook',
                'url' => 'https://facebook.com/restaurantgourmet',
                'icon' => 'facebook',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'platform' => 'whatsapp',
                'title' => 'WhatsApp Order & Inquiry',
                'url' => 'https://wa.me/1234567890',
                'icon' => 'whatsapp',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'platform' => 'tiktok',
                'title' => 'TikTok',
                'url' => 'https://tiktok.com/@restaurant_gourmet',
                'icon' => 'tiktok',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }
    }
}
