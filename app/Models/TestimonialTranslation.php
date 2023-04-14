<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'comment', 'language', 'testimonial_id'];

    public function parentTestimonial()
    {
        return $this->belongsTo(Testimonial::class, 'testimonial_id', 'id');
    }
}
