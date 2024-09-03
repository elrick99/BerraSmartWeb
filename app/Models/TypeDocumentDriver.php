<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocumentDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'has_expiry_date',
        'status',
    ];

}
