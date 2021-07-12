@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                @if(detectarPrivacidad("crear","usuarios",$config,auth()->user()->role))
                {!! btnModal("users",null,"AGREGAR USUARIOS",null) !!}
                @endif
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $usuarios,
            'tabla' => "users",
            'editar' => json_encode(["inputtext","email","pass","selectArr","multibotones","inputtext","inputnumber","imagen"]),
            'exep' => "ninguna",
            'titulos' => ["Nombre","Email","Rol","Estado","Direccion","Celular","Sede","Foto"],
            'columnas' =>["name","email","role","estado","direccion","celular","stores","foto"],
            'area'=>"usuarios",
            'config'=>$config,
            'tipo' =>["normal","normal","normal","estado","normal","normal","multibotones","imagen"]])
        {!! $usuarios->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.usuarios',['title' => 'Agregar Usuarios','url' => route('users.store'),'modal' => 'users'])

@endsection
