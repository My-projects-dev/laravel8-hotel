<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelInformationTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','language','info_id'];

     public function parentInfo()
    {
        return $this->belongsTo(HotelInformation::class, 'info_id', 'id');
    }
}
