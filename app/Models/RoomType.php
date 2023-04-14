<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title','language','room_type_id'];
    protected $fillable = ['status'];

    public function roomTypeTranslation(): HasMany
    {
        return $this->hasMany(RoomTypeTranslation::class, 'room_type_id', 'id');
    }
}
