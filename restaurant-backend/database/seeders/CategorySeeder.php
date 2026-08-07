<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Appetizers & Starters',
                'slug' => 'appetizers-starters',
                'description' => 'Crispy bites and mouth-watering starters to spark your appetite.',
                'image_path' => 'https://images.unsplash.com/photo-1541529086526-db283c563270?w=800',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Chef Specials',
                'slug' => 'chef-specials',
                'description' => 'Signature dishes crafted with premium seasonal ingredients.',
                'image_path' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Main Courses',
                'slug' => 'main-courses',
                'description' => 'Hearty, satisfying entrees prepared by our expert chefs.',
                'image_path' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Artisanal Desserts',
                'slug' => 'artisanal-desserts',
                'description' => 'Decadent sweets, handcrafted tarts, and gourmet ice cream.',
                'image_path' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Craft Beverages & Cocktails',
                'slug' => 'craft-beverages-cocktails',
                'description' => 'Refreshing mocktails, specialty coffee, and signature cocktails.',
                'image_path' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=800',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
