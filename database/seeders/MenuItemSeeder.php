<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $menuItems = [
            // ============================================
            // RICE & CURRY
            // ============================================
            [
                'category_slug' => 'rice-curry',
                'name' => 'Rice & Curry - Chicken',
                'slug' => 'rice-curry-chicken',
                'description' => 'Traditional Sri Lankan rice with chicken curry, dhal, and sambols',
                'price' => 480.00,
                'image_url' => 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'category_slug' => 'rice-curry',
                'name' => 'Rice & Curry - Fish',
                'slug' => 'rice-curry-fish',
                'description' => 'Traditional Sri Lankan rice with fish curry, dhal, and sambols',
                'price' => 450.00,
                'image_url' => 'https://images.unsplash.com/photo-1567337710282-00d59b1d8a77?w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'category_slug' => 'rice-curry',
                'name' => 'Rice & Curry - Egg',
                'slug' => 'rice-curry-egg',
                'description' => 'Traditional Sri Lankan rice with egg curry, dhal, and sambols',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1588166524941-3bf61a9c41db?w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'category_slug' => 'rice-curry',
                'name' => 'Rice & Curry - Beef',
                'slug' => 'rice-curry-beef',
                'description' => 'Traditional Sri Lankan rice with beef curry, dhal, and sambols',
                'price' => 650.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'category_slug' => 'rice-curry',
                'name' => 'Rice & Curry - Vegetable',
                'slug' => 'rice-curry-vegetable',
                'description' => 'Traditional Sri Lankan rice with vegetable curry, dhal, and sambols',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=800&q=80',
                'sort_order' => 5,
            ],

            // ============================================
            // FRIED RICE
            // ============================================
            [
                'category_slug' => 'fried-rice',
                'name' => 'Chicken Fried Rice (Full)',
                'slug' => 'chicken-fried-rice-full',
                'description' => 'Flavorful fried rice with tender chicken pieces',
                'price' => 950.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Chicken Fried Rice (Half)',
                'slug' => 'chicken-fried-rice-half',
                'description' => 'Flavorful fried rice with tender chicken pieces - Half portion',
                'price' => 650.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Vegetable Fried Rice (Full)',
                'slug' => 'vegetable-fried-rice-full',
                'description' => 'Fresh vegetables stir-fried with aromatic rice',
                'price' => 800.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Vegetable Fried Rice (Half)',
                'slug' => 'vegetable-fried-rice-half',
                'description' => 'Fresh vegetables stir-fried with aromatic rice - Half portion',
                'price' => 500.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Egg Fried Rice (Full)',
                'slug' => 'egg-fried-rice-full',
                'description' => 'Classic fried rice with scrambled eggs',
                'price' => 850.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 5,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Egg Fried Rice (Half)',
                'slug' => 'egg-fried-rice-half',
                'description' => 'Classic fried rice with scrambled eggs - Half portion',
                'price' => 550.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 6,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Mix Fried Rice (Full)',
                'slug' => 'mix-fried-rice-full',
                'description' => 'Fried rice with a mix of chicken, vegetables, and eggs',
                'price' => 1650.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 7,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Mix Fried Rice (Half)',
                'slug' => 'mix-fried-rice-half',
                'description' => 'Fried rice with a mix of chicken, vegetables, and eggs - Half portion',
                'price' => 1250.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 8,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Daiyaa Special Fried Rice',
                'slug' => 'daiyaa-special-fried-rice',
                'description' => 'Our signature fried rice with premium ingredients',
                'price' => 2000.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'is_featured' => true,
                'sort_order' => 9,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Nasi Goreng (Full)',
                'slug' => 'nasi-goreng-full',
                'description' => 'Indonesian-style fried rice with aromatic spices',
                'price' => 1600.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 10,
            ],
            [
                'category_slug' => 'fried-rice',
                'name' => 'Nasi Goreng (Half)',
                'slug' => 'nasi-goreng-half',
                'description' => 'Indonesian-style fried rice with aromatic spices - Half portion',
                'price' => 1300.00,
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80',
                'sort_order' => 11,
            ],

            // ============================================
            // KOTTU
            // ============================================
            [
                'category_slug' => 'kottu',
                'name' => 'Chicken Kottu (Full)',
                'slug' => 'chicken-kottu-full',
                'description' => 'Chopped roti stir-fried with chicken, vegetables, and aromatic spices',
                'price' => 900.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Chicken Kottu (Half)',
                'slug' => 'chicken-kottu-half',
                'description' => 'Chopped roti stir-fried with chicken, vegetables, and aromatic spices - Half portion',
                'price' => 600.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Egg Kottu (Full)',
                'slug' => 'egg-kottu-full',
                'description' => 'Chopped roti stir-fried with eggs and vegetables',
                'price' => 800.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Egg Kottu (Half)',
                'slug' => 'egg-kottu-half',
                'description' => 'Chopped roti stir-fried with eggs and vegetables - Half portion',
                'price' => 500.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Cheese Kottu (Full)',
                'slug' => 'cheese-kottu-full',
                'description' => 'Delicious kottu with melted cheese',
                'price' => 1400.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 5,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Cheese Kottu (Half)',
                'slug' => 'cheese-kottu-half',
                'description' => 'Delicious kottu with melted cheese - Half portion',
                'price' => 1200.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 6,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Mix Kottu (Full)',
                'slug' => 'mix-kottu-full',
                'description' => 'Kottu with a mix of chicken, eggs, and vegetables',
                'price' => 1650.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 7,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Mix Kottu (Half)',
                'slug' => 'mix-kottu-half',
                'description' => 'Kottu with a mix of chicken, eggs, and vegetables - Half portion',
                'price' => 1250.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 8,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Dolphin Kottu (Full)',
                'slug' => 'dolphin-kottu-full',
                'description' => 'Special kottu with seafood',
                'price' => 1200.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 9,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Dolphin Kottu (Half)',
                'slug' => 'dolphin-kottu-half',
                'description' => 'Special kottu with seafood - Half portion',
                'price' => 900.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 10,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Beef Kottu (Full)',
                'slug' => 'beef-kottu-full',
                'description' => 'Chopped roti stir-fried with tender beef and vegetables',
                'price' => 1200.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 11,
            ],
            [
                'category_slug' => 'kottu',
                'name' => 'Beef Kottu (Half)',
                'slug' => 'beef-kottu-half',
                'description' => 'Chopped roti stir-fried with tender beef and vegetables - Half portion',
                'price' => 900.00,
                'image_url' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                'sort_order' => 12,
            ],

            // ============================================
            // SHORT EATS / ROTI ITEMS
            // ============================================
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Egg Roti',
                'slug' => 'egg-roti',
                'description' => 'Soft roti with scrambled eggs',
                'price' => 150.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Paratha',
                'slug' => 'paratha',
                'description' => 'Flaky layered flatbread',
                'price' => 120.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Vegetable Roti',
                'slug' => 'vegetable-roti',
                'description' => 'Roti filled with spiced vegetables',
                'price' => 150.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Fish Roti',
                'slug' => 'fish-roti',
                'description' => 'Roti filled with spiced fish',
                'price' => 200.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Beef Roti',
                'slug' => 'beef-roti',
                'description' => 'Roti filled with spiced beef',
                'price' => 250.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 5,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Thosai',
                'slug' => 'thosai',
                'description' => 'Crispy fermented crepe made from rice and lentils',
                'price' => 180.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 6,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Pancake',
                'slug' => 'pancake',
                'description' => 'Soft and fluffy pancakes',
                'price' => 150.00,
                'image_url' => 'https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=800&q=80',
                'sort_order' => 7,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Egg Rolls',
                'slug' => 'egg-rolls',
                'description' => 'Crispy rolls filled with eggs',
                'price' => 200.00,
                'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=80',
                'sort_order' => 8,
            ],
            [
                'category_slug' => 'short-eats-roti',
                'name' => 'Vegetable Rolls',
                'slug' => 'vegetable-rolls',
                'description' => 'Crispy rolls filled with vegetables',
                'price' => 180.00,
                'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=80',
                'sort_order' => 9,
            ],

            // ============================================
            // NOODLES
            // ============================================
            [
                'category_slug' => 'noodles',
                'name' => 'Chicken Noodles',
                'slug' => 'chicken-noodles',
                'description' => 'Stir-fried noodles with tender chicken pieces',
                'price' => 850.00,
                'image_url' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'category_slug' => 'noodles',
                'name' => 'Egg Noodles',
                'slug' => 'egg-noodles',
                'description' => 'Stir-fried noodles with scrambled eggs',
                'price' => 750.00,
                'image_url' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'category_slug' => 'noodles',
                'name' => 'Beef Noodles',
                'slug' => 'beef-noodles',
                'description' => 'Stir-fried noodles with tender beef',
                'price' => 950.00,
                'image_url' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'category_slug' => 'noodles',
                'name' => 'Vegetable Noodles',
                'slug' => 'vegetable-noodles',
                'description' => 'Stir-fried noodles with fresh vegetables',
                'price' => 700.00,
                'image_url' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'category_slug' => 'noodles',
                'name' => 'Mix Noodles',
                'slug' => 'mix-noodles',
                'description' => 'Stir-fried noodles with a mix of chicken, eggs, and vegetables',
                'price' => 1000.00,
                'image_url' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80',
                'sort_order' => 5,
            ],
            [
                'category_slug' => 'noodles',
                'name' => 'String Hopper Kottu',
                'slug' => 'string-hopper-kottu',
                'description' => 'Chopped string hoppers stir-fried with vegetables and spices',
                'price' => 800.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 6,
            ],
            [
                'category_slug' => 'noodles',
                'name' => 'String Hoppers (Red)',
                'slug' => 'string-hoppers-red',
                'description' => 'Steamed rice noodles with red curry',
                'price' => 200.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 7,
            ],
            [
                'category_slug' => 'noodles',
                'name' => 'String Hoppers (White)',
                'slug' => 'string-hoppers-white',
                'description' => 'Steamed rice noodles with white curry',
                'price' => 200.00,
                'image_url' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=800&q=80',
                'sort_order' => 8,
            ],

            // ============================================
            // SALADS
            // ============================================
            [
                'category_slug' => 'salads',
                'name' => 'Vegetable Salad',
                'slug' => 'vegetable-salad',
                'description' => 'Fresh mixed vegetables with dressing',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&q=80',
                'sort_order' => 1,
            ],

            // ============================================
            // FRESH JUICES
            // ============================================
            [
                'category_slug' => 'fresh-juices',
                'name' => 'Mixed Fruit Juice',
                'slug' => 'mixed-fruit-juice',
                'description' => 'Freshly squeezed mixed fruit juice',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'category_slug' => 'fresh-juices',
                'name' => 'Watermelon Juice',
                'slug' => 'watermelon-juice',
                'description' => 'Freshly squeezed watermelon juice',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'category_slug' => 'fresh-juices',
                'name' => 'Avocado Juice',
                'slug' => 'avocado-juice',
                'description' => 'Creamy and refreshing avocado juice',
                'price' => 350.00,
                'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'category_slug' => 'fresh-juices',
                'name' => 'Guava Juice',
                'slug' => 'guava-juice',
                'description' => 'Freshly squeezed guava juice',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'category_slug' => 'fresh-juices',
                'name' => 'Orange Juice',
                'slug' => 'orange-juice',
                'description' => 'Freshly squeezed orange juice',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=800&q=80',
                'sort_order' => 5,
            ],
            [
                'category_slug' => 'fresh-juices',
                'name' => 'Lemon Juice',
                'slug' => 'lemon-juice',
                'description' => 'Freshly squeezed lemon juice',
                'price' => 300.00,
                'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=800&q=80',
                'sort_order' => 6,
            ],
        ];

        foreach ($menuItems as $item) {
            $category = Category::where('slug', $item['category_slug'])->first();
            unset($item['category_slug']);
            
            if ($category) {
                $item['category_id'] = $category->id;
                // Generate slug if not provided
                if (!isset($item['slug'])) {
                    $item['slug'] = Str::slug($item['name']);
                }
                // Ensure unique slug - check if exists and not the current item
                $baseSlug = $item['slug'];
                $originalSlug = $item['slug'];
                $counter = 1;
                $existingItem = MenuItem::where('slug', $item['slug'])->first();
                
                // If exists and we're not updating it, make it unique
                if ($existingItem) {
                    // Check if it's the same item (same name and category) - if so, update it
                    if ($existingItem->name === $item['name'] && $existingItem->category_id === $category->id) {
                        // Same item, will be updated by updateOrCreate
                    } else {
                        // Different item with same slug, make it unique
                        while (MenuItem::where('slug', $item['slug'])->exists()) {
                            $item['slug'] = $baseSlug . '-' . $counter;
                            $counter++;
                        }
                    }
                }
                
                MenuItem::updateOrCreate(
                    ['slug' => $item['slug']],
                    $item
                );
            }
        }
    }
}
