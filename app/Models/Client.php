<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'rut_empresa',
        'rubro',
        'razon_social',
        'telefono',
        'direccion',
        'nombre_contacto',
        'email_contacto',
    ];
}
