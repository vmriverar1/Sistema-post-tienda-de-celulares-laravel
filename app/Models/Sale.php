<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    const NORMAL = 'NORMAL';
    const PROMOCION = 'PROMOCION';
    const CUPON = 'CUPON';
    const NINGUNO = 'NINGUNO';
    const TIENDA = "TIENDA";
    const ONLINE = "ONLINE";
    const DELIVERY = "DELIVERY";

    protected $fillable = ['trabajador','caja','cliente','nota','tipo','pedido','subtotal','tipo_descuento','descuento','igv','vuelto','total',"store"];
}
