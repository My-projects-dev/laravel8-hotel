<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','language','facility_id'];

     public function parentFacility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
