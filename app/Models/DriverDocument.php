<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDocument extends Model
{
    use HasFactory;

    protected $table = 'driver_documents';

    protected $fillable = [
        'driver_id',
        'type_document_id',
        'identify_number',
        'expiry_date',
        'status',
    ];

    /**
     * Driver With Driver Document
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
