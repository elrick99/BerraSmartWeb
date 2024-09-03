<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeMarque extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'description', 'status'];

    /**
     * Type Vehicule With Vehicule Type
     */
    public function vehicule_type()
    {
        return $this->hasMany(VehiculeType::class, 'vehicule_marque_id');
    }
}
