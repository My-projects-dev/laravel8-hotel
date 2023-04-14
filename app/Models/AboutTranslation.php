<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'language','about_id'];

    public function parentAbout()
    {
        return $this->belongsTo(About::class, 'about_id', 'id');
    }
}
