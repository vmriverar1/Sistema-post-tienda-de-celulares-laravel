<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    use HasFactory;
    const ABIERTA = 'ABIERTA';
    const CERRADA = 'CERRADA';
    protected $fillable = ["responsable","sede","ingreso","egreso","estado","saldo","store"];
}
