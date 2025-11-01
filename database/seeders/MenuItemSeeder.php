<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $menuItems = [
            // Rice & Curry
            [
                'category_slug' => 'rice-curry',
                'name' => 'Rice & Curry',
                'slug' => 'rice-curry-dish',
                'description' => 'Traditional Sri Lankan rice with multiple curry varieties, dhal, and sambols',
                'price' => 850.00,
                'image_url' => 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=600&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            // Kottu & Roti
            [
                'category_slug' => 'kottu-roti',
                'name' => 'Kottu Roti',
                'slug' => 'kottu-roti',
                'description' => 'Chopped roti stir-fried with vegetables, eggs, and your choice of meat',
                'price' => 650.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=600&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            // Hoppers
            [
                'category_slug' => 'hoppers',
                'name' => 'Hoppers',
                'slug' => 'hoppers',
                'description' => 'Crispy bowl-shaped pancakes served with coconut sambol and spicy curry',
                'price' => 450.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=600&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            // Seafood
            [
                'category_slug' => 'seafood',
                'name' => 'Seafood Platter',
                'slug' => 'seafood-platter',
                'description' => 'Fresh catch of the day with prawns, calamari, and fish in aromatic spices',
                'price' => 1450.00,
                'image_url' => 'https://images.unsplash.com/photo-1567337710282-00d59b1d8a77?w=600&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            // Special Dishes
            [
                'category_slug' => 'special-dishes',
                'name' => 'Lamprais',
                'slug' => 'lamprais',
                'description' => 'Dutch-Burgher specialty: rice, meat, sambols wrapped in banana leaf',
                'price' => 950.00,
                'image_url' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=600&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            // Desserts
            [
                'category_slug' => 'desserts',
                'name' => 'Curd & Treacle',
                'slug' => 'curd-treacle',
                'description' => 'Creamy buffalo curd drizzled with sweet kithul treacle - a perfect dessert',
                'price' => 350.00,
                'image_url' => 'https://images.unsplash.com/photo-1626804475297-41608ea09aeb?w=600&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($menuItems as $item) {
            $category = Category::where('slug', $item['category_slug'])->first();
            unset($item['category_slug']);
            
            if ($category) {
                $item['category_id'] = $category->id;
                MenuItem::create($item);
            }
        }
    }
}

