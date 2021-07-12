@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","productos",$config,auth()->user()->role))
                {!! btnModal("products",null,"AGREGAR PRODUCTOS",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $productos,
            'tabla' => "products",
            'editar' => json_encode(["inputtext","inputtext","textarea","multibotones","multibotones","multibotones-simple","inputnumber","inputnumber","inputnumber","inputnumber","inputnumber","inputnumber","inputnumber","inputnumber","multimedia","imagen"]),
            'exep' => "ninguna",
            'titulos' => ["Nombre","Código","Descripción","Categorias","Subcategorias","Precio","Costo","Estado","Tipo","Multimedia","Imagen"],
            'columnas' =>["nombre","cod_prod","descripcion","categoria_id","subcategoria_id","precio","costo","estado","tipo","multimedia","foto"],
            'area'=>"productos",
            'config'=>$config,
            'tipo' =>["normal","normal","normal","multibotones","multibotones","inputnumber","inputnumber","estado","normal","multimedia","imagen"]])
        {!! $productos->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.productos',['title' => 'Agregar Producto','url' => route('products.store'),'modal' => 'products','cats'=>$cats,'subs'=>$subs,'marcas'=>$marcas])

@endsection
