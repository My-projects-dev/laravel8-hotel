<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class About extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['content', 'language','about_id'];
    protected $fillable = ['status'];

    public function aboutTranslation(): HasMany
    {
        return $this->hasMany(AboutTranslation::class, 'about_id', 'id');
    }

    public function aboutImage(): HasMany
    {
        return $this->hasMany(AboutImage::class, 'about_id', 'id');
    }
}
