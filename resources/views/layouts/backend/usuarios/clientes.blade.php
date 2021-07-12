@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","clientes",$config,auth()->user()->role))
                {!! btnModal("clients",null,"AGREGAR CLIENTES",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $clientes,
            'tabla' => "clients",
            'editar' => json_encode(["inputtext","inputtext","inputtext","inputtext","inputtext","imagen"]),
            'exep' => "ninguna",
            'titulos' => ["Nombre","Email","Direccion","Celular","Foto"],
            'columnas' =>["nombre","email","direccion","celular","foto"],
            'area'=>"clientes",
            'config'=>$config,
            'tipo' =>["normal","normal","normal","normal","imagen"]])
        {!! $clientes->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.clientes',['title' => 'Agregar Cliente','url' => route('clients.store'),'modal' => 'clients'])

@endsection
