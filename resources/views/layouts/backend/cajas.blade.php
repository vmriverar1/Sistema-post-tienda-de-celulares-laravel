@extends('layouts.backend.plantilla')

@section('contenido1')
<div class="padding">

    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","usuarios",$config,auth()->user()->role))
                {!! btnModal("cashboxes",null,"AGREGAR CAJA",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $cajas,
            'tabla' => "cashboxes",
            'editar' => json_encode(["inputtext","inputtext"]),
            'exep' => "ninguna",
            'titulos' => ["Responsable","Ingreso","Egreso","Saldo","Total","Sede","Estado"],
            'columnas' =>["responsable","ingreso","egreso","saldo","total","sede","estado"],
            'area'=>"rcajas",
            'config'=>$config,
            'tipo' =>["normal","normal","normal","normal","normal","normal","normal"]])
        {!! $cajas->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.cajas',['title' => 'Agregar Caja','url' => route('cashboxes.store'),'modal' => 'cashboxes','usuarios'=>$usuarios,'stores'=>$stores])
@endsection
