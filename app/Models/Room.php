<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['slug', 'title', 'language', 'overview', 'rules', 'room_id'];
    protected $fillable = ['status', 'price', 'adult', 'child', 'room_type_id', 'number_of_rooms'];

    public function parentRoomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }

    public function roomImage(): HasMany
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }

    public function roomTranslation(): HasMany
    {
        return $this->hasMany(RoomTranslation::class, 'room_id', 'id');
    }

    public function roomAmenity(): HasMany
    {
        return $this->hasMany(RoomAmenity::class, 'room_id', 'id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'room_id', 'id');
    }
}
