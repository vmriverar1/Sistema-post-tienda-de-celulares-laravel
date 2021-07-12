@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","sedes",$config,auth()->user()->role))
                {!! btnModal("store",null,"AGREGAR SEDE",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $stores,
            'tabla' => "store",
            'editar' => json_encode(["inputtext","inputtext","inputtext","inputtext","inputtext","imagen"]),
            'exep' => "ninguna",
            'titulos' => ["Nombre","RUC","Celular","Dirección","Administrador","Foto"],
            'columnas' =>["nombre","ruc","celular","direccion","administrador","foto"],
            'area'=>"sedes",
            'config'=>$config,
            'tipo' =>["normal","normal","normal","normal","normal","imagen"]])
        {!! $stores->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.store',['title' => 'Agregar Producto','url' => route('store.store'),'modal' => 'store','cats'=>$usuarios])

@endsection
