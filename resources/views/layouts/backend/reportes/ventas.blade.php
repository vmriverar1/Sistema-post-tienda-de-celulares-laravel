@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="filtrosVentas divForm filtroDataVentas">
    <div class="form-group">
        <div class="input-group date">
          <input type='text' class="form-control inicioFecha" placeholder="Fecha inicio" readonly="">
          <span class="input-group-addon">
              <span class="fa fa-calendar"></span>
          </span>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group date">
          <input type='text' class="form-control Finfecha" placeholder="Fecha final" readonly="">
          <span class="input-group-addon">
              <span class="fa fa-calendar"></span>
          </span>
        </div>
    </div>

    <div class="buscadorProductos">

        <button class="btn primary buscarReportesVentas"><i class="fa fa-search"></i></button>
    </div>
</div>

<div class="col-sm-12">
    <div class="b-b b-primary nav-active-primary">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-toggle="tab" data-target="#tab4" aria-expanded="true">Ventas</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab5" aria-expanded="false">Compras</a></li>
            {{-- <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab6" aria-expanded="false">Gráficos</a></li> --}}
        </ul>
    </div>
    <div class="tab-content p-a m-b-md">

        <div class="tab-pane animated fadeIn text-muted active" id="tab4" aria-expanded="true">


            <div class="tablaCajaChica">
                <div class="columnaData">
                    <button type="button" class="btn btn-outline b-info">Caja</button>
                    <button type="button" class="btn btn-outline b-info">Cliente</button>
                    <button type="button" class="btn btn-outline b-info">Nota</button>
                    <button type="button" class="btn btn-outline b-info">Productos</button>
                    <button type="button" class="btn btn-outline b-info">Subtotal</button>
                    <button type="button" class="btn btn-outline b-info">Descuento</button>
                    <button type="button" class="btn btn-outline b-info">Total</button>
                    <button type="button" class="btn btn-outline b-info">Acciones</button>
                </div>
                <div class="bodyCaja ventasData">
                    @forelse ($ventas as $venta)
                        <div class="columnaData interiorData">
                            <div class="data">{{$venta->caja}}</div>
                            <div class="data">{{$venta->cliente}}</div>
                            <div class="data">{{$venta->nota}}</div>
                            <div class="data">{!!$venta->pedido!!}</div>
                            <div class="data">{{"S/.".number_format($venta->subtotal,2)}}</div>
                            <div class="data">{{"S/.".number_format($venta->descuento,2)}}</div>
                            <div class="data">{{"S/.".number_format($venta->total,2)}}</div>
                            @if (detectarPrivacidad("eliminar","ventas",$config,auth()->user()->role))
                                <a class="dropdown-item eliminar danger" tabla="sales" iditem="{{$venta->id}}">
                                    <i class="fa fa-trash"></i>Eliminar
                                </a>
                            @endif
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>




        </div>
        <div class="tab-pane animated fadeIn text-muted" id="tab5" aria-expanded="false">

            <div class="tablaCajaChica">
                <div class="columnaData2">
                    <button type="button" class="btn btn-outline b-info">Responsable</button>
                    <button type="button" class="btn btn-outline b-info">Tipo</button>
                    <button type="button" class="btn btn-outline b-info">Descripción</button>
                    <button type="button" class="btn btn-outline b-info">Total</button>
                    <button type="button" class="btn btn-outline b-info">Fecha</button>
                    <button type="button" class="btn btn-outline b-info">acciones</button>
                </div>
                <div class="bodyCaja GastosData">
                    @forelse ($gastos as $gasto)
                        <div class="columnaData2 interiorData">
                            <div class="data">{{$gasto->responsable}}</div>
                            <div class="data">{{$gasto->tipo}}</div>
                            <div class="data">
                                @if($gasto->tipo == "PRODUCTOS")
                                    {!!$gasto->productos!!}</div>
                                @else
                                    {{$gasto->descripcion}}</div>
                                @endif
                            <div class="data">{{"S/.".number_format($gasto->total,2)}}</div>
                            <div class="data">{!! strftime($gasto->created_at, strtotime( date('Y-m-d') )) !!}</div>
                            @if (detectarPrivacidad("eliminar","ventas",$config,auth()->user()->role))
                                <a class="dropdown-item eliminar danger" tabla="spends" iditem="{{$gasto->id}}">
                                    <i class="fa fa-trash"></i>Eliminar
                                </a>
                            @endif
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>

        </div>
        <div class="tab-pane animated fadeIn text-muted" id="tab6" aria-expanded="false">







        </div>
    </div>
</div>

<style type="text/css">
    .white{
        display: block;
        /*background-color: black;*/
    }
    .app-header{
        position: initial;
    }
    .filtrosVentas{
        display: grid;
        grid-template-columns: repeat(4, auto);
        column-gap: 2%;
        padding: 10px;
    }
    .columnaData{
        display: grid;
        grid-template-columns: repeat(8, 12.5%);
        /*align-items: center;*/
        /*justify-items: center;*/
    }
    .columnaData2{
        display: grid;
        grid-template-columns: repeat(6, 17%);
        /*align-items: center;*/
        /*justify-items: center;*/
    }
    .interiorData:hover{
        background-color: yellow;
    }
    .data{
        margin: 10px auto;
        display: grid;
        /*grid-template-columns: repeat(5, 20%);*/
        align-items: center;
        justify-items: center;
    }

</style>

{{-- <div class="padding">
    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                {!! btnModal("categories",null,null,null) !!}
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $categorias,
            'editar' => json_encode(["inputtext","inputtext","textarea","imagen"]),
            'tabla' => "categories",
            'exep' => "ninguna",
            'titulos' => ["Nombre","Titular","Descripción","Estado","Imagen"],
            'columnas' =>["nombre","titular","descripcion","estado","foto"],
            'tipo' =>["normal","normal","normal","estado","imagen"]])
        {!! $categorias->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>

@include('layouts.backend.modals.categorias',['title' => 'Agregar Categoria','url' => route('categories.store'),'modal' => 'categories']) --}}

@endsection
