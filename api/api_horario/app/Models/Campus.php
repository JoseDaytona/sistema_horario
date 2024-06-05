<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $primaryKey = 'CampusID';
    protected $table = 'Campus';
    protected $fillable = [
        'Descripcion',
        'Estado'
    ];
    protected $attributes = [
        'Descripcion' => "",
        'Estado' => ""
    ];
}
