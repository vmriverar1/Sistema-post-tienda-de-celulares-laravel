@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","proveedores",$config,auth()->user()->role))
                {!! btnModal("suppliers",null,"AGREGAR PROVEEDOR",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $proveedor,
            'tabla' => "suppliers",
            'editar' => json_encode(["inputtext","inputtext","inputtext","inputtext","inputtext","imagen"]),
            'exep' => "ninguna",
            'titulos' => ["Nombre","Email","RUC","Dirección","Celular","Foto"],
            'columnas' =>["nombre","email","ruc","direccion","celular","foto"],
            'area'=>"proveedores",
            'config'=>$config,
            'tipo' =>["normal","normal","normal","normal","normal","imagen"]])
        {!! $proveedor->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.proveedores',['title' => 'Agregar Proveedor','url' => route('suppliers.store'),'modal' => 'suppliers'])

@endsection
