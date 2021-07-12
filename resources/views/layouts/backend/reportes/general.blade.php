@extends('layouts.backend.plantilla')

@section('contenido1')

{{-- <div class="filtrosVentas divForm filtroDataVentas">
    <div class="form-group">
        <div class="input-group date">
          <input type='text' class="form-control buscarFecha" placeholder="ingresa fecha" readonly="">
          <span class="input-group-addon">
              <span class="fa fa-calendar"></span>
          </span>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group date">
          <input type='text' class="form-control buscarFecha" placeholder="ingresa fecha" readonly="">
          <span class="input-group-addon">
              <span class="fa fa-calendar"></span>
          </span>
        </div>
    </div>

    <div class="buscadorProductos">
        <input type="text" class="form-control buscarImei" placeholder="Buscar por IMEI" style="color:white" value="">
    </div>

    <div class="buscadorProductos">

        <button class="btn primary buscarVenta"><i class="fa fa-search"></i></button>
    </div>
</div> --}}

<div class="col-sm-12">
    <div class="b-b b-primary nav-active-primary">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-toggle="tab" data-target="#tab4" aria-expanded="true">Productos más vendidos</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab5" aria-expanded="false">Productos menos vendidos</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab6" aria-expanded="false">Balance de tiendas</a></li>
        </ul>
    </div>
    <div class="tab-content p-a m-b-md">

        <div class="tab-pane animated fadeIn text-muted active" id="tab4" aria-expanded="true">

            <div class="tablaCajaChica">
                <div class="columnaData">
                    <button type="button" class="btn btn-outline b-info">Producto</button>
                    <button type="button" class="btn btn-outline b-info">Foto</button>
                    <button type="button" class="btn btn-outline b-info">Costo</button>
                    <button type="button" class="btn btn-outline b-info">Ingreso</button>
                    <button type="button" class="btn btn-outline b-info">Ganancia</button>
                </div>
                <div class="bodyCaja">
                    @forelse ($productosmas as $producto)
                        <div class="columnaData interiorData">
                            <div class="data">{{$producto->nombre}}</div>
                            <div class="data"><img src="{{asset($producto->foto)}}" class="img-thumbnail previsualizarfn" width="100px"></div>
                            <div class="data">{{"S/.".number_format($producto->costo*$producto->ventas,2)}}</div>
                            <div class="data">{{"S/.".number_format($producto->precio*$producto->ventas,2)}}</div>
                            <div class="data">{{"S/.".number_format($producto->precio*$producto->ventas - $producto->costo*$producto->ventas,2)}}</div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>

        </div>
        <div class="tab-pane animated fadeIn text-muted" id="tab5" aria-expanded="false">

            <div class="tablaCajaChica">
                <div class="columnaData">
                    <button type="button" class="btn btn-outline b-info">Producto</button>
                    <button type="button" class="btn btn-outline b-info">Foto</button>
                    <button type="button" class="btn btn-outline b-info">Costo</button>
                    <button type="button" class="btn btn-outline b-info">Ingreso</button>
                    <button type="button" class="btn btn-outline b-info">Ganancia</button>
                </div>
                <div class="bodyCaja">
                    @forelse ($productosmenos as $producto)
                        <div class="columnaData interiorData">
                            <div class="data">{{$producto->nombre}}</div>
                            <div class="data"><img src="{{asset($producto->foto)}}" class="img-thumbnail previsualizarfn" width="100px"></div>
                            <div class="data">{{"S/.".number_format($producto->costo*$producto->ventas,2)}}</div>
                            <div class="data">{{"S/.".number_format($producto->precio*$producto->ventas,2)}}</div>
                            <div class="data">{{"S/.".number_format($producto->precio*$producto->ventas - $producto->costo*$producto->ventas,2)}}</div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>

        </div>
        <div class="tab-pane animated fadeIn text-muted" id="tab6" aria-expanded="false">

            <div class="tablaCajaChica">
                <div class="columnaData">
                    <button type="button" class="btn btn-outline b-info">Tienda</button>
                    <button type="button" class="btn btn-outline b-info">Ingreso</button>
                    <button type="button" class="btn btn-outline b-info">Egreso</button>
                    <button type="button" class="btn btn-outline b-info">Saldo</button>
                    <button type="button" class="btn btn-outline b-info">Total</button>
                </div>
                <div class="bodyCaja">
                    @forelse ($tiendas as $tienda)
                        <div class="columnaData interiorData">
                            <div class="data">{{$tienda->nombre}}</div>
                            <div class="data">{{"S/.".number_format($tienda->ingreso,2)}}</div>
                            <div class="data">{{"S/.".number_format($tienda->egreso,2)}}</div>
                            <div class="data">{{"S/.".number_format($tienda->saldo,2)}}</div>
                            <div class="data">{{"S/.".number_format($tienda->total,2)}}</div>
                        </div>
                    @empty
                    @endforelse
                    <div class="columnaData success">
                        <div class="data" style="font-weight: bold;"></div>
                        <div class="data" style="font-weight: bold;">{{"S/.".number_format($ingresotoal,2)}}</div>
                        <div class="data" style="font-weight: bold;">{{"S/.".number_format($egresotoal,2)}}</div>
                        <div class="data" style="font-weight: bold;">{{"S/.".number_format($saldotoal,2)}}</div>
                        <div class="data" style="font-weight: bold;">{{"S/.".number_format($totatoal,2)}}</div>
                    </div>
                </div>
            </div>





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
        grid-template-columns: repeat(5, 20%);
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
