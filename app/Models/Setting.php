<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Lấy giá trị setting theo key
     */
    public static function getValue($key, $default = null)
    {
        $setting = Cache::remember("setting_{$key}", 3600, function () use ($key) {
            return self::where('key', $key)->first();
        });

        return $setting ? $setting->value : $default;
    }

    /**
     * Lấy tất cả thông tin liên hệ của shop
     */
    public static function getContactInfo()
    {
        return Cache::remember('shop_contact_info', 3600, function () {
            $contactKeys = [
                'shop_name',
                'shop_address',
                'shop_phone',
                'shop_email',
                'shop_website',
                'shop_facebook',
                'shop_instagram',
                'shop_working_hours',
                'shop_description',
            ];

            $settings = self::whereIn('key', $contactKeys)->get();
            $contactInfo = [];

            foreach ($settings as $setting) {
                $contactInfo[$setting->key] = $setting->value;
            }

            return $contactInfo;
        });
    }

    /**
     * Cập nhật giá trị setting
     */
    public static function setValue($key, $value)
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear cache
        Cache::forget("setting_{$key}");
        Cache::forget('shop_contact_info');

        return $setting;
    }
}
