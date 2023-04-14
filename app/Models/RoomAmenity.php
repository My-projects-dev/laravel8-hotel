<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAmenity extends Model
{
    use HasFactory;

    protected $fillable = ['amenity_id','room_id'];

    public function parentRoom()
    {
        return $this->belongsTo(RoomTranslation::class, 'room_id', 'id');
    }

    public function parentAmenity()
    {
        return $this->belongsTo(Amenity::class, 'amenity_id', 'id');
    }
}
