<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'button_title','button_url','language','slider_id'];

    public function parentSlider()
    {
        return $this->belongsTo(Slider::class, 'slider_id', 'id');
    }
}
