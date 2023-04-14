<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelInformation extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title','content','language','info_id'];
    protected $fillable = ['image', 'status',];

    public function infoTranslation(): HasMany
    {
        return $this->hasMany(HotelInformationTranslation::class, 'info_id', 'id');
    }
}
