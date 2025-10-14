<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'prioridad',
        'estado',
        'solicitante',
        'asignado',
        'fechas',
        'fecha_actualizacion',
    ];

    public $timestamps = false;

    protected $casts = [
        'fechas' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones (opcional, si existen las otras tablas)
    |--------------------------------------------------------------------------
    */
    public function categoriaRel()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }

    public function solicitanteRel()
    {
        return $this->belongsTo(User::class, 'solicitante');
    }

    public function asignadoRel()
    {
        return $this->belongsTo(User::class, 'asignado');
    }
}
