<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenityTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title','language','amenity_id'];

    public function parentAmenity()
    {
        return $this->belongsTo(Amenity::class, 'amenity_id', 'id');
    }
}
