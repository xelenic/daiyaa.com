<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        Promotion::create([
            'title' => 'Grand Opening Special! 🎉',
            'description' => 'Get 30% OFF on all orders this week! Experience authentic Sri Lankan cuisine at unbeatable prices. Order now and taste the difference!',
            'image_url' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80',
            'is_active' => true,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(7),
            'sort_order' => 0,
        ]);

        Promotion::create([
            'title' => 'Weekend Feast Offer! 🍛',
            'description' => 'Every Saturday & Sunday - Buy 2 Main Courses, Get 1 Dessert FREE! Limited time offer. Don\'t miss out!',
            'image_url' => 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=800&q=80',
            'is_active' => true,
            'start_date' => null,
            'end_date' => null,
            'sort_order' => 1,
        ]);
    }
}
