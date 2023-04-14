<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'position', 'language', 'team_id'];

    public function parentTeam()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
