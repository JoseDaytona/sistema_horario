<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edificios extends Model
{
    protected $primaryKey = 'EdificioID';
    protected $table = 'Edificios';
    protected $fillable = [
        'Descripcion',
        'CampusID',
        'Estado'
    ];
    protected $attributes = [
        'Descripcion' => "",
        'CampusID' => 0,
        'Estado' => ""
    ];
}
