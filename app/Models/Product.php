<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 protected $fillable = [
        'sku',
        'nombre',
        'descripcion_corta',
        'descripcion_larga',
        'imagen',
        'precio_neto',
        'precio_venta',
        'stock_actual',
        'stock_minimo',
        'stock_bajo',
        'stock_alto',
    ];

protected $appends = ['precio_con_iva'];

public function getPrecioConIvaAttribute()
{
    return round($this->precio_neto * 1.19, 2);
}

}
