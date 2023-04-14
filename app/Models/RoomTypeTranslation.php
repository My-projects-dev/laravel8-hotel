<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'language', 'room_type_id'];

    public function parentRoomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }
}
