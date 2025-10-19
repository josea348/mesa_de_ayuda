<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificaReservaEquipo extends Model
{
    use HasFactory;
    protected $table = 'notificacion_reserva_equipo';
    protected $fillable = [
        'titulo'
        'comentario'
        'res_equipo_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
    ];


    // --------------------------------------------------------------------------
    // RELACIONES DE ELOQUENT
    // --------------------------------------------------------------------------

    public function reservaEquipo(): BelongsTo
    {
        return $this->belongsTo(ReservaEquipo::class, 'res_equipo_id');
    }
}
