<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ambientes extends Model
{
    use HasFactory;
    protected $table = 'ambientes';
    protected $fillable = [
        'nombre'
        'ubicacion'
        'capacidad'
        'estado'
        'area_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'capacidad' => 'integer',
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
    ];


    // --------------------------------------------------------------------------
    // RELACIONES DE ELOQUENT
    // --------------------------------------------------------------------------

    public function areaIdRel()
    {
        return $this->belongsTo(Areas::class, 'area_id');
    }

    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'ambiente_id');
    }
}
