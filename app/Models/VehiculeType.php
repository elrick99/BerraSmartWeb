<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeType extends Model
{
    use HasFactory;

    protected $fillable = ['libelle','description','vehicule_marque_id','status'];

    /**
     * Marque Vehicule With Vehicule Type
     */
    public function vehicule_marque()
    {
        return $this->belongsTo(VehiculeMarque::class, 'vehicule_marque_id');
    }
}
