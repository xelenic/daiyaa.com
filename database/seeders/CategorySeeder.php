<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rice & Curry',
                'slug' => 'rice-curry',
                'description' => 'Traditional Sri Lankan rice dishes with aromatic curries',
                'sort_order' => 1,
            ],
            [
                'name' => 'Kottu & Roti',
                'slug' => 'kottu-roti',
                'description' => 'Popular street food favorites',
                'sort_order' => 2,
            ],
            [
                'name' => 'Hoppers',
                'slug' => 'hoppers',
                'description' => 'Crispy bowl-shaped pancakes - a Sri Lankan breakfast staple',
                'sort_order' => 3,
            ],
            [
                'name' => 'Seafood',
                'slug' => 'seafood',
                'description' => 'Fresh catches prepared with authentic Sri Lankan spices',
                'sort_order' => 4,
            ],
            [
                'name' => 'Special Dishes',
                'slug' => 'special-dishes',
                'description' => 'Unique Sri Lankan specialty dishes',
                'sort_order' => 5,
            ],
            [
                'name' => 'Desserts',
                'slug' => 'desserts',
                'description' => 'Traditional sweet treats',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

