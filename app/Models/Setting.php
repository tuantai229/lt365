<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array'
    ];

    /**
     * Get setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $cacheKey = "setting_{$key}";
        
        return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set setting value
     */
    public static function set(string $key, $value): self
    {
        $setting = static::updateOrCreate(['key' => $key], ['value' => $value]);
        
        // Clear cache
        Cache::forget("setting_{$key}");
        
        return $setting;
    }

    /**
     * Get general settings
     */
    public static function getGeneralSettings(): array
    {
        return static::get('general_settings', [
            'domain' => '',
            'hotline' => '',
            'email' => '',
            'address' => '',
            'working_hours' => '',
            'footer_intro' => '',
            'facebook' => '',
            'youtube' => '',
            'instagram' => '',
            'tiktok' => '',
        ]);
    }

    /**
     * Get menu navigation
     */
    public static function getMainNavigation(): array
    {
        return static::get('main_navigation', []);
    }

    /**
     * Get footer category links
     */
    public static function getFooterCategoryLinks(): array
    {
        return static::get('footer_category_links', []);
    }

    /**
     * Get footer support links
     */
    public static function getFooterSupportLinks(): array
    {
        return static::get('footer_support_links', []);
    }

    /**
     * Get home hero slides
     */
    public static function getHomeHeroSlides(): array
    {
        return static::get('home_hero_slides', []);
    }

    /**
     * Get home quick transfer settings
     */
    public static function getHomeQuickTransfer(): array
    {
        return static::get('home_quick_transfer', [
            'title' => 'Đồng hành cùng con vào trường chuyên',
            'boxes' => []
        ]);
    }

    /**
     * Get home news schedule settings
     */
    public static function getHomeNewsSchedule(): array
    {
        return static::get('home_news_schedule', [
            'selected_category_id' => null
        ]);
    }

    /**
     * Get home teachers centers settings
     */
    public static function getHomeTeachersCenters(): array
    {
        return static::get('home_teachers_centers', [
            'centers' => [],
            'teachers' => []
        ]);
    }

    /**
     * Get home stats reviews settings
     */
    public static function getHomeStatsReviews(): array
    {
        return static::get('home_stats_reviews', [
            'stats' => [
                'documents' => '10,000+',
                'schools' => '500+',
                'members' => '50,000+',
                'rating' => '4.8/5'
            ],
            'reviews' => []
        ]);
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache(): void
    {
        $keys = [
            'general_settings', 
            'main_navigation', 
            'footer_category_links', 
            'footer_support_links',
            'home_hero_slides',
            'home_quick_transfer',
            'home_news_schedule',
            'home_teachers_centers',
            'home_stats_reviews'
        ];
        
        foreach ($keys as $key) {
            Cache::forget("setting_{$key}");
        }
    }
}
