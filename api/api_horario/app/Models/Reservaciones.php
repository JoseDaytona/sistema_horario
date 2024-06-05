<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    protected $primaryKey = 'ReservacionID';
    protected $table = 'Reservaciones';
    protected $fillable = [
        'EmpleadoID',
        'AulaID',
        'UsuarioID',
        'FechaReservacion',
        'CantidadHoras',
        'Comentario',
        'Estado'
    ];
    protected $attributes = [
        'EmpleadoID' => 0,
        'AulaID' => 0,
        'UsuarioID' => 0,
        'FechaReservacion' => "",
        'CantidadHoras' => 0,
        'Comentario' => "",
        'Estado' => ""
    ];
}
