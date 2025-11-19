<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cities',
        'postal_codes',
        'delivery_fee',
        'min_order_amount',
        'estimated_time',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'delivery_fee' => 'decimal:2',
        'is_active' => 'boolean',
        'min_order_amount' => 'integer',
        'estimated_time' => 'integer',
        'sort_order' => 'integer',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get cities as array
     */
    public function getCitiesArrayAttribute(): array
    {
        if (empty($this->cities)) {
            return [];
        }
        
        return array_map('trim', explode(',', $this->cities));
    }

    /**
     * Get postal codes as array
     */
    public function getPostalCodesArrayAttribute(): array
    {
        if (empty($this->postal_codes)) {
            return [];
        }
        
        return array_map('trim', explode(',', $this->postal_codes));
    }

    /**
     * Check if zone covers a given city
     */
    public function coversCity(string $city): bool
    {
        $cities = $this->cities_array;
        
        foreach ($cities as $zoneCity) {
            if (stripos($city, $zoneCity) !== false || stripos($zoneCity, $city) !== false) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Check if zone covers a given postal code
     */
    public function coversPostalCode(?string $postalCode): bool
    {
        if (empty($postalCode)) {
            return false;
        }
        
        $postalCodes = $this->postal_codes_array;
        
        if (empty($postalCodes)) {
            return false;
        }
        
        return in_array(trim($postalCode), $postalCodes);
    }

    /**
     * Find delivery zone by city and postal code
     */
    public static function findForLocation(string $city, ?string $postalCode = null): ?self
    {
        $zones = self::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // First try to match by postal code if provided
        if (!empty($postalCode)) {
            foreach ($zones as $zone) {
                if ($zone->coversPostalCode($postalCode)) {
                    return $zone;
                }
            }
        }

        // Then try to match by city
        foreach ($zones as $zone) {
            if ($zone->coversCity($city)) {
                return $zone;
            }
        }

        return null;
    }

    /**
     * Calculate delivery fee for a given order amount
     */
    public function calculateFee(float $orderAmount): float
    {
        if ($orderAmount >= $this->min_order_amount && $this->min_order_amount > 0) {
            return 0; // Free delivery if minimum order amount is met
        }

        return (float) $this->delivery_fee;
    }
}


