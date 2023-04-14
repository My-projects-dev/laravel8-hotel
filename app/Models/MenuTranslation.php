<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['button_title', 'button_url','language','menu_id'];

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
