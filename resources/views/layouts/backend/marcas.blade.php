@extends('layouts.backend.plantilla')

@section('contenido1')
<div class="padding">

    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","marcas",$config,auth()->user()->role))
                {!! btnModal("brands",null,"AGREGAR MARCAS",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $marcas,
            'tabla' => "brands",
            'editar' => json_encode(["inputtext","imagen"]),
            'exep' => "ninguna",
            'titulos' => ["Marca","Logo"],
            'columnas' =>["nombre","foto"],
            'area'=>"marcas",
            'config'=>$config,
            'tipo' =>["normal","imagen"]])
        {!! $marcas->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.marcas',['title' => 'Agregar Marca','url' => route('brands.store'),'modal' => 'brands'])
@endsection
