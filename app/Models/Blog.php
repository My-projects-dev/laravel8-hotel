<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['slug', 'title','content','language','blog_id'];
    protected $fillable = ['image', 'status',];

    public function blogTranslation(): HasMany
    {
        return $this->hasMany(BlogTranslation::class, 'blog_id', 'id');
    }
}
