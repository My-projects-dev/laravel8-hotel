<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

     protected $fillable = ['value', 'language', 'setting_id'];

    public function parentSetting()
    {
        return $this->belongsTo(Setting::class, 'setting_id', 'id');
    }
}
