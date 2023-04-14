<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChefTranslation extends Model
{
    use HasFactory;

     protected $fillable = ['full_name', 'position','about','language','chef_id'];

    public function parentChef()
    {
        return $this->belongsTo(Chef::class, 'chef_id', 'id');
    }
}
