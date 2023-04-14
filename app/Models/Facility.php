<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title','description','language','facility_id'];
    protected $fillable = ['image', 'status',];

    public function facilityTranslation(): HasMany
    {
        return $this->hasMany(FacilityTranslation::class, 'facility_id', 'id');
    }
}
