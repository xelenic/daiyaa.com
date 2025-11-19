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
                'name' => 'Fried Rice',
                'slug' => 'fried-rice',
                'description' => 'Flavorful fried rice dishes with various options',
                'sort_order' => 2,
            ],
            [
                'name' => 'Kottu',
                'slug' => 'kottu',
                'description' => 'Popular Sri Lankan street food - chopped roti with vegetables and meat',
                'sort_order' => 3,
            ],
            [
                'name' => 'Short Eats / Roti Items',
                'slug' => 'short-eats-roti',
                'description' => 'Quick bites and roti items',
                'sort_order' => 4,
            ],
            [
                'name' => 'Noodles',
                'slug' => 'noodles',
                'description' => 'Delicious noodle dishes',
                'sort_order' => 5,
            ],
            [
                'name' => 'Salads',
                'slug' => 'salads',
                'description' => 'Fresh and healthy salads',
                'sort_order' => 6,
            ],
            [
                'name' => 'Fresh Juices',
                'slug' => 'fresh-juices',
                'description' => 'Freshly squeezed fruit juices',
                'sort_order' => 7,
            ],
            [
                'name' => 'Hoppers',
                'slug' => 'hoppers',
                'description' => 'Crispy bowl-shaped pancakes - a Sri Lankan breakfast staple',
                'sort_order' => 8,
            ],
            [
                'name' => 'Seafood',
                'slug' => 'seafood',
                'description' => 'Fresh catches prepared with authentic Sri Lankan spices',
                'sort_order' => 9,
            ],
            [
                'name' => 'Special Dishes',
                'slug' => 'special-dishes',
                'description' => 'Unique Sri Lankan specialty dishes',
                'sort_order' => 10,
            ],
            [
                'name' => 'Desserts',
                'slug' => 'desserts',
                'description' => 'Traditional sweet treats',
                'sort_order' => 11,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}

