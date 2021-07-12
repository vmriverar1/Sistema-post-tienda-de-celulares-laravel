@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","usuarios",$config,auth()->user()->role))
                    {!! btnModal("users",null,"AGREGAR ADMINISTRADOR",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $usuarios,
            'tabla' => "users",
            'editar' => json_encode(["inputtext","email","pass","imagen"]),
            'exep' => "ninguna",
            'titulos' => ["Nombre","email","Foto"],
            'columnas' =>["name","email","photo"],
            'area'=>"usuarios",
            'config'=>$config,
            'tipo' =>["normal","normal","imagen"]])
        {!! $usuarios->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.usuarios',['title' => 'Agregar Usuario','url' => route('usuarios.store'),'modal' => 'users'])
@endsection
