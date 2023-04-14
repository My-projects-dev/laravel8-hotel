<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['full_name', 'position', 'language', 'team_id'];
    protected $fillable = ['image', 'status','email', 'facebook', 'twitter', 'linkedin'];

    public function teamTranslation(): HasMany
    {
        return $this->hasMany(TeamTranslation::class, 'team_id', 'id');
    }
}
