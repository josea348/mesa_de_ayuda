<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservasEquipo extends Model
{
    use HasFactory;
    protected $table = 'reservas_equipo';
    protected $fillable = [
        'usuario_id'
        'equipo_id'
        'fecha_inicio'
        'fecha_fin'
        'estado'
    ];

    public $timestamps = false;

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];


    // --------------------------------------------------------------------------
    // RELACIONES DE ELOQUENT
    // --------------------------------------------------------------------------

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id', 'identificacion');
    }

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
