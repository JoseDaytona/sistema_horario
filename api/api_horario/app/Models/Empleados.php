<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $primaryKey = 'EmpleadoID';
    protected $table = 'Empleados';
    protected $fillable = [
        'Nombre',
        'Cedula',
        'TandaLabor',
        'FechaIngreso',
        'CorreoElectronico',
        'NoCarnet',
        'Estado'

    ];
    protected $attributes = [
        'Nombre' => "",
        'Cedula' => "",
        'TandaLabor' => "",
        'FechaIngreso' => "",
        'CorreoElectronico' => "",
        'NoCarnet' => "",
        'Estado' => ""
    ];
}
