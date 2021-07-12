<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    use HasFactory;
    protected $fillable = ['responsable','tipo','descripcion','total',"store","foto","salida","comprobante","igv","cod_comprobante","productos"];
}
