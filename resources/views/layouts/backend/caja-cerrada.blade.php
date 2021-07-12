@extends('layouts.backend.plantilla')

@section('contenido1')
   <div class="contenedor">
        <div class="danger">
            <form class="form-horizontal" id="abrirCajaForm" method="POST" action="{{route('cashboxes.abrir')}}">
                @csrf
                <h2>ESTA CAJA ESTA CERRADA</h2>
                {!! modalEntrada("inputprecio","monto","cashbox","Monto inicial","Escribir el gasto total",null,null,null) !!}
                <button class="btn btn-fw success abrirCaja">Abrir caja</button>
            </form>
        </div>
   </div>
   <style type="text/css">
        .contenedor{
            width: 100%;
        }
        .danger{
            padding: 20%;
            text-align: center;
        }
   </style>
@endsection
