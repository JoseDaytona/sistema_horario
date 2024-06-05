<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $primaryKey = 'AulaID';
    protected $table = 'Aulas';
    protected $fillable = [
        'Descripcion',
        'TipoAulaID',
        'EdificioID',
        'Capacidad',
        'CuposReservados',
        'Estado'
    ];
    protected $attributes = [
        'Descripcion' => "",
        'TipoAulaID' => 0,
        'EdificioID' => 0,
        'Capacidad' => 0,
        'CuposReservados' => 0,
        'Estado' => 0,
    ];
}
