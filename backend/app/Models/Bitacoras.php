<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacoras extends Model
{
    use HasFactory;
    protected $table = 'bitacoras';
    protected $fillable = [
        'accion'
        'detalle'
        'ticket_id'
        'usuario_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
    ];


    // --------------------------------------------------------------------------
    // RELACIONES DE ELOQUENT
    // --------------------------------------------------------------------------

    public function ticketIdRel()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }

    public function usuarioIdRel()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'identificacion');       
    }
}
