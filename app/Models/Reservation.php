<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'checkin_date',
        'checkout_date',
        'price',
        'adult',
        'child',
        'infant',
        'company_name',
        'name',
        'surname',
        'email',
        'phone',
        'country',
        'city',
        'zip'
    ];

    public function parentRoom()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
