<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    public function run(): void
    {
        $appetizers = Category::where('slug', 'appetizers-starters')->first();
        $specials = Category::where('slug', 'chef-specials')->first();
        $mains = Category::where('slug', 'main-courses')->first();
        $desserts = Category::where('slug', 'artisanal-desserts')->first();
        $drinks = Category::where('slug', 'craft-beverages-cocktails')->first();

        $dishes = [
            [
                'category_id' => $appetizers?->id ?? 1,
                'name' => 'Truffle Arancini Balls',
                'slug' => 'truffle-arancini-balls',
                'description' => 'Crispy risotto balls infused with black truffle emulsion and melted mozzarella.',
                'price' => 14.50,
                'image_path' => 'https://images.unsplash.com/photo-1541529086526-db283c563270?w=800',
                'is_available' => true,
                'is_featured' => true,
                'calories' => 420,
                'prep_time_minutes' => 15,
                'ingredients' => ['Arborio Rice', 'Black Truffle', 'Mozzarella', 'Parmesan', 'Panko'],
            ],
            [
                'category_id' => $appetizers?->id ?? 1,
                'name' => 'Seared Ahi Tuna Tartare',
                'slug' => 'seared-ahi-tuna-tartare',
                'description' => 'Fresh yellowfin tuna tossed with avocado mousse, sesame oil, and crispy wonton chips.',
                'price' => 18.00,
                'image_path' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800',
                'is_available' => true,
                'is_featured' => false,
                'calories' => 310,
                'prep_time_minutes' => 12,
                'ingredients' => ['Yellowfin Tuna', 'Avocado', 'Soy Dressing', 'Sesame Seeds', 'Wonton Crisp'],
            ],
            [
                'category_id' => $specials?->id ?? 2,
                'name' => 'Wagyu Ribeye Steak (300g)',
                'slug' => 'wagyu-ribeye-steak',
                'description' => 'Grade A5 Australian Wagyu served with roasted garlic butter and truffle jus.',
                'price' => 48.00,
                'image_path' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800',
                'is_available' => true,
                'is_featured' => true,
                'calories' => 780,
                'prep_time_minutes' => 25,
                'ingredients' => ['A5 Wagyu Beef', 'Herb Garlic Butter', 'Bone Marrow Jus', 'Rosemary'],
            ],
            [
                'category_id' => $specials?->id ?? 2,
                'name' => 'Pan-Seared Lobster Risotto',
                'slug' => 'pan-seared-lobster-risotto',
                'description' => 'Butter-poached Maine lobster tail served over saffron creamy risotto.',
                'price' => 39.50,
                'image_path' => 'https://images.unsplash.com/photo-1553240799-36bbf332a5c3?w=800',
                'is_available' => true,
                'is_featured' => true,
                'calories' => 640,
                'prep_time_minutes' => 20,
                'ingredients' => ['Maine Lobster', 'Saffron', 'Carnaroli Rice', 'Chardonnay', 'Butter'],
            ],
            [
                'category_id' => $mains?->id ?? 3,
                'name' => 'Smoked Honey Glazed Salmon',
                'slug' => 'smoked-honey-glazed-salmon',
                'description' => 'Wild Norwegian salmon roasted with honey mustard glaze over asparagus spears.',
                'price' => 28.50,
                'image_path' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=800',
                'is_available' => true,
                'is_featured' => false,
                'calories' => 520,
                'prep_time_minutes' => 18,
                'ingredients' => ['Norwegian Salmon', 'Wild Honey', 'Dijon Mustard', 'Baby Asparagus'],
            ],
            [
                'category_id' => $mains?->id ?? 3,
                'name' => 'Handcrafted Tagliatelle Bolognese',
                'slug' => 'handcrafted-tagliatelle-bolognese',
                'description' => 'Fresh egg pasta tossed in slow-cooked 8-hour beef shank and veal ragu.',
                'price' => 22.00,
                'image_path' => 'https://images.unsplash.com/photo-1621996346565-e3d5d6281292?w=800',
                'is_available' => true,
                'is_featured' => false,
                'calories' => 590,
                'prep_time_minutes' => 15,
                'ingredients' => ['Fresh Pasta', 'Braised Beef & Veal', 'San Marzano Tomato', 'Aged Parmigiano'],
            ],
            [
                'category_id' => $desserts?->id ?? 4,
                'name' => 'Molten Chocolate Lava Cake',
                'slug' => 'molten-chocolate-lava-cake',
                'description' => 'Warm Valrhona dark chocolate cake with gooey center and Madagascar vanilla bean gelato.',
                'price' => 12.00,
                'image_path' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800',
                'is_available' => true,
                'is_featured' => true,
                'calories' => 450,
                'prep_time_minutes' => 10,
                'ingredients' => ['Valrhona 70% Dark Chocolate', 'Fresh Cream', 'Vanilla Bean Gelato'],
            ],
            [
                'category_id' => $drinks?->id ?? 5,
                'name' => 'Smoked Passionfruit Old Fashioned',
                'slug' => 'smoked-passionfruit-old-fashioned',
                'description' => 'Bourbon whiskey infused with passionfruit puree, Angostura bitters, and oakwood smoke.',
                'price' => 15.00,
                'image_path' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=800',
                'is_available' => true,
                'is_featured' => false,
                'calories' => 180,
                'prep_time_minutes' => 5,
                'ingredients' => ['Bourbon', 'Passionfruit Puree', 'Bitters', 'Orange Peel'],
            ],
        ];

        foreach ($dishes as $dish) {
            Dish::updateOrCreate(['name' => $dish['name']], $dish);
        }
    }
}
