<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $fillable = [
        'nombre'
        'descripcion'
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
    ];
}
