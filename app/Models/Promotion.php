<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'is_active',
        'start_date',
        'end_date',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopeActive($query)
    {
        $today = now()->toDateString();
        
        return $query->where('is_active', true)
            ->where(function($q) use ($today) {
                $q->whereNull('start_date')
                  ->orWhereDate('start_date', '<=', $today);
            })
            ->where(function($q) use ($today) {
                $q->whereNull('end_date')
                  ->orWhereDate('end_date', '>=', $today);
            });
    }
}
