<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Testimonial extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['full_name', 'comment', 'language', 'testimonial_id'];
    protected $fillable = ['star', 'status',];

    public function testimonialTranslation(): HasMany
    {
        return $this->hasMany(TestimonialTranslation::class, 'testimonial_id', 'id');
    }
}
