<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColisImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'image',
        'image_time',
        'status'
    ];

    /**
     * Image Colis With Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
