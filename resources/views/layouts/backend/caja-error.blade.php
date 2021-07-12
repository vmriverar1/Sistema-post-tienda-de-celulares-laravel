@extends('layouts.backend.plantilla')

@section('contenido1')
   <div class="contenedor">
        <div class="danger">
           <h2>No se te ha asignado aun una caja</h2>
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
