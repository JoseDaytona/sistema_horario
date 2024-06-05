<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $primaryKey = 'UsuarioID';
    protected $table = 'Usuarios';
    protected $fillable = [
        'Usuario',
        'TipoUsuario',
        'Clave',
        'Estado',
        'EmpleadoID'
    ];
    protected $attributes = [
        'Usuario' => "",
        'TipoUsuario' => "",
        'Clave' => "",
        'Estado' => "", 
        'EmpleadoID' => 0
    ];
}
