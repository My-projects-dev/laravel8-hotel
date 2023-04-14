<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class RoomTranslation extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['slug','title','language','overview','rules', 'price','room_id'];

    public function parentRoom()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
