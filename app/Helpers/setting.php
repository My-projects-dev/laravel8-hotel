<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('settings')) {

    function settings(string $key)
    {
        $locale=app()->getLocale();

        if (!Cache::has('settings')) {
            $settings = Cache::remember('settings', 86400, function () {
                return \App\Models\SettingTranslation::with('parentSetting')->get();
            });
        } else {
            $settings = Cache::get('settings');
        }

        foreach ($settings as $setting) {
            if ($setting->parentSetting->key === $key and $setting->language ==$locale) {

                return $setting->value;
            }
        }

        return '';
    }
}


if (!function_exists('hascache')) {
    function hascache($key)
    {
        if (!Cache::has($key)) {
            Cache::remember($key, 86400, function () use ($key) {
                return DB::table($key)->get();
            });
        }
    }
}
