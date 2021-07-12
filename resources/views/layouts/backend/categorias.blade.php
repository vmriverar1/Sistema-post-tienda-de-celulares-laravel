@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","categorias",$config,auth()->user()->role))
                {!! btnModal("categories",null,"AGREGAR CATEGORIAS",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $categorias,
            'editar' => json_encode(["inputtext","inputtext","textarea","imagen"]),
            'tabla' => "categories",
            'exep' => "ninguna",
            'titulos' => ["Nombre","Titular","Descripción","Estado","Imagen"],
            'columnas' =>["nombre","titular","descripcion","estado","foto"],
            'area'=>"categorias",
            'config'=>$config,
            'tipo' =>["normal","normal","normal","estado","imagen"]])
        {!! $categorias->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.categorias',['title' => 'Agregar Categoria','url' => route('categories.store'),'modal' => 'categories'])

@endsection
