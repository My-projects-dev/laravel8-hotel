<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearByTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['button_title', 'button_url', 'language','near_id'];

    public function parentNear()
    {
        return $this->belongsTo(NearBy::class, 'near_id', 'id');
    }
}
