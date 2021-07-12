@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                {{-- {!! btnModal("ventas",null,null,null) !!} --}}
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $ventas,
            'tabla' => "sale",
            'exep' => "ninguna",
            'titulos' => ["Nombre","Descripción","Estado","Tipo","Pago","Cliente","Entrega","Datos","Imagen"],
            'columnas' =>["nombre","descripcion","estado","tipo","pago","cliente","datos","photo"],
            'tipo' =>["normal","normal","delivery","normal","dinero","normal","imagen","imagen"]])
        {!! $ventas->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

{{-- @include('layouts.backend.modals.categorias',['title' => 'Agregar Categoria','url' => route('categorias.store'),'modal' => 'categorias','cats'=>$cats,'subs'=>$subs]) --}}

@endsection
