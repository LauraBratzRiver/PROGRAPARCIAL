<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    protected $fillable = [
        'idReservacion', 'idCliente', 'Hora'
    ];
}
