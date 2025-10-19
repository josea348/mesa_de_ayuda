<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificaReservaAmbiente extends Model
{
    use HasFactory;
    protected $table = 'notifica_reserva_ambiente';
    protected $fillable = [
        'titulo'
        'comentario'
        'res_ambiente_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
    ];


    // --------------------------------------------------------------------------
    // RELACIONES DE ELOQUENT
    // --------------------------------------------------------------------------

    public function reservaAmbiente(): BelongsTo
    {
        return $this->belongsTo(ReservaAmbiente::class, 'res_ambiente_id');
    }
}
