<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $fillable = ['idAlumno', 'codigo', 'nombre', 'direccion', 'telefono','tipoAutomotor'];
}
