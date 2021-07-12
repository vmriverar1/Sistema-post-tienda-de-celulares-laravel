@extends('layouts.backend.plantilla')

@section('contenido1')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <div class="navbar no-radius box-shadow-z1 m-t">
                    @if(detectarPrivacidad("crear","subcategorias",$config,auth()->user()->role))
                    {!! btnModal("subcategories",null,"AGREGAR SUBCATEGORIA",null) !!}
                    @endif
                </div>
            </div>
            @include('layouts.backend.partes.tabla',[
                'arr' => $subcategorias,
                'tabla' => "subcategories",
                'editar' => json_encode(["inputtext","multibotones","inputtext","inputnumber"]),
                'exep' => "ninguna",
                'titulos' => ["Nombre","Categorias","Titular","Descripción","Estado"],
                'columnas' =>["nombre","categoria_id","titular","descripcion","estado"],
                'area'=>"subcategorias",
                'config'=>$config,
               'tipo' =>["normal","multibotones","normal","normal","estado"]])
            {!! $subcategorias->appends(request()->query())->links('layouts.paginador') !!}
        </div>
    </div>

    @include('layouts.backend.modals.subcategorias',['title' => 'Agregar Subategoria','url' => route('subcategories.store'),'modal' => 'subcategories','cats'=>$cats,'subs'=>$subs])
@endsection
