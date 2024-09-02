<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'active',
    ];

    /**
     * Commune With Ville
     */
    public function communes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Commune::class);
    }
}
