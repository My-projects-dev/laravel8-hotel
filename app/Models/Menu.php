<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['button_title', 'button_url', 'language', 'menu_id'];
    protected $fillable = ['image', 'status',];

    public function menuTranslation(): HasMany
    {
        return $this->hasMany(MenuTranslation::class, 'menu_id', 'id');
    }
}
