<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryZone;

class DeliveryZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            [
                'name' => 'Kathmandu Central',
                'cities' => 'Kathmandu, Thamel, Durbar Marg, New Road, Basantapur',
                'postal_codes' => '44600, 44601, 44602',
                'delivery_fee' => 50.00,
                'min_order_amount' => 500,
                'estimated_time' => 30,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Kathmandu Ring Road Area',
                'cities' => 'Balaju, Kalimati, Koteshwor, Baneshwor, Maharajgunj',
                'postal_codes' => '44603, 44604, 44605',
                'delivery_fee' => 80.00,
                'min_order_amount' => 800,
                'estimated_time' => 40,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Lalitpur',
                'cities' => 'Lalitpur, Patan, Jawalakhel, Kupondole, Sanepa',
                'postal_codes' => '44700, 44701, 44702',
                'delivery_fee' => 100.00,
                'min_order_amount' => 1000,
                'estimated_time' => 45,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Bhaktapur',
                'cities' => 'Bhaktapur, Suryabinayak, Madhyapur Thimi',
                'postal_codes' => '44800, 44801, 44802',
                'delivery_fee' => 150.00,
                'min_order_amount' => 1200,
                'estimated_time' => 60,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Kathmandu Outskirts',
                'cities' => 'Budhanilkantha, Tokha, Gokarneshwor, Kirtipur',
                'postal_codes' => '44606, 44607, 44608',
                'delivery_fee' => 120.00,
                'min_order_amount' => 1000,
                'estimated_time' => 50,
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($zones as $zone) {
            DeliveryZone::create($zone);
        }
    }
}


