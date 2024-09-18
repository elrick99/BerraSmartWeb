<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'lieu_arrivee', 'lieu_depart', 'user_id', 'driver_id', 'price', 'duration', 'is_paid', 'etat'];

    /**
     * Course With User
     */
    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Course With Driver
     */
    public function driver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    /**
     * Course With Image Colis
     */
    public function colis_images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ColisImage::class, 'course_id');
    }

    /**
     * Course Livree
     */
    public static function courseLivree()
    {
        return self::where('etat', 'livree')->get();
    }
}
