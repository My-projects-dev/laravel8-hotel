<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NearBy extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['button_title', 'button_url', 'language','near_id'];
    protected $fillable = ['image', 'status'];

    public function nearTranslation(): HasMany
    {
        return $this->hasMany(NearByTranslation::class, 'near_id', 'id');
    }
}
