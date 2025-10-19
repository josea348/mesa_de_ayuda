<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    use HasFactory;
    protected $table = 'equipos';
    protected $fillable = [
        'nombre'
        'descripcion'
        'tipo'
        'estado'
        'ambiente_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
    ];


    // --------------------------------------------------------------------------
    // RELACIONES DE ELOQUENT
    // --------------------------------------------------------------------------

    public function ambienteIdRel()
    {
        return $this->belongsTo(Ambientes::class, 'ambiente_id');
    }
}
