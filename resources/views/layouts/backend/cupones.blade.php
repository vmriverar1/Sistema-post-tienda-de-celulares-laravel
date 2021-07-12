@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                {!! btnModal("categorias",null,null,null) !!}
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $categorias,
            'editar' => json_encode(["inputtext","inputtext","textarea","inputnumber","selectArr","multibotones","imagen"]),
            'tabla' => "categorias",
            'exep' => "ninguna",
            'titulos' => ["Nombre","Titular","Descripción","Menú","Portada","Estado","Complementos","Imagen"],
            'columnas' =>["nombre","titular","descripcion","orden_menu","orden_catalogo","estado","complementos","imagen"],
            'tipo' =>["normal","normal","normal","normal","normal","estado","multibotones","imagen"]])
        {!! $categorias->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.categorias',['title' => 'Agregar Categoria','url' => route('categorias.store'),'modal' => 'categorias','cats'=>$cats,'subs'=>$subs])

@endsection
