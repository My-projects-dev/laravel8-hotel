<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['value', 'language', 'setting_id'];
    protected $fillable = ['image', 'status','key'];

    public function settingTranslation(): HasMany
    {
        return $this->hasMany(SettingTranslation::class, 'setting_id', 'id');
    }
}
