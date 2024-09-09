<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicule_marque_id',
        'name',
        'vehicule_type_id',
        'car_color',
        'car_number',
        'today_trip_count',
        'total_accept',
        'total_reject',
        'status',
        'approve',
        'available',
        'gender',
    ];

    /**
     * User With Driver
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
