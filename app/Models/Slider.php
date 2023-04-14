<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title', 'subtitle', 'button_title','button_url','language','slider_id'];
    protected $fillable = ['image', 'status','star'];

    public function sliderTranslation(): HasMany
    {
        return $this->hasMany(SliderTranslation::class, 'slider_id', 'id');
    }
}
