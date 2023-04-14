<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chef extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['full_name', 'position','about','language','chef_id'];
    protected $fillable = ['image', 'status',];

    public function chefTranslation(): HasMany
    {
        return $this->hasMany(ChefTranslation::class, 'chef_id', 'id');
    }
}
