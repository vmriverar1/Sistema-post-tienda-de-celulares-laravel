<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const FIJO = 'FIJO';
    const CAMBIANTE = 'CAMBIANTE';


    protected $fillable = ['nombre','descripcion','ventas','categoria_id','subcategoria_id','imei','brand','tipoprecio','precio','stock','minimomayor','preciomayor','costo','tipo','multimedia','foto',"store","cod_prod","estado"];
}
