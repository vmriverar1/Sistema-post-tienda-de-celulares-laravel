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

        <button class="btn primary buscarCajaChica"><i class="fa fa-search"></i></button>
    </div>
</div>

<div class="col-sm-12">
    <div class="b-b b-primary nav-active-primary">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-toggle="tab" data-target="#tab4" aria-expanded="true">Caja chica tienda</a></li>
            @if (auth()->user()->role == "ADMIN")
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab5" aria-expanded="false">Caja chica Tiendas</a></li>
            @endif
            {{-- <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab6" aria-expanded="false">Balance de tiendas</a></li> --}}
            <input type="hidden" class="tiendaActual" value="{{valorStore()}}">
        </ul>
    </div>
    <div class="tab-content p-a m-b-md">

        <div class="tab-pane animated fadeIn text-muted active" id="tab4" aria-expanded="true">

            <div class="tablaCajaChica">
                <div class="cabeceraCaja">
                    <button type="button" class="btn btn-outline b-info">Ingreso</button>
                    <button type="button" class="btn btn-outline b-info">Saldo</button>
                    <button type="button" class="btn btn-outline b-info">Egreso</button>
                    <button type="button" class="btn btn-outline b-info">Total</button>
                    <button type="button" class="btn btn-outline b-info">Responsable</button>
                    <button type="button" class="btn btn-outline b-info">Fecha</button>
                    <button type="button" class="btn btn-outline b-info">Acciones</button>
                </div>
                <div class="bodyCaja dataBox1">
                    @forelse ($cajasdata as $caja)
                        @if($caja->store == valorStore())
                        <div class="columCaja">
                            <div class="dataCaja">{{"S/.".number_format($caja->ingreso,2)}}</div>
                            <div class="dataCaja">{{"S/.".number_format($caja->egreso,2)}}</div>
                            <div class="dataCaja">{{"S/.".number_format($caja->saldo,2)}}</div>
                            <div class="dataCaja">{{"S/.".number_format($caja->total,2)}}</div>
                            <div class="dataCaja">{{$caja->nombre}}</div>
                            <div class="dataCaja">{!! strftime($caja->created_at, strtotime( date('Y-m-d') )) !!}</div>
                            @if (detectarPrivacidad("eliminar","caja",$config,auth()->user()->role))
                                <a class="dropdown-item eliminar danger" tabla="cashbox" iditem="{{$caja->id}}">
                                    <i class="fa fa-trash"></i>Eliminar
                                </a>
                            @endif
                        </div>
                        @endif
                    @empty
                    @endforelse


                </div>
            </div>

        </div>
        @if (auth()->user()->role == "ADMIN")
            <div class="tab-pane animated fadeIn text-muted" id="tab5" aria-expanded="false">
                <div class="tablaCajaChica">
                    <div class="cabeceraCaja2">
                        <button type="button" class="btn btn-outline b-info">Tienda</button>
                        <button type="button" class="btn btn-outline b-info">Ingreso</button>
                        <button type="button" class="btn btn-outline b-info">Saldo</button>
                        <button type="button" class="btn btn-outline b-info">Egreso</button>
                        <button type="button" class="btn btn-outline b-info">Total</button>
                        <button type="button" class="btn btn-outline b-info">Responsable</button>
                        <button type="button" class="btn btn-outline b-info">Fecha</button>
                        <button type="button" class="btn btn-outline b-info">Acciones</button>
                    </div>
                    <div class="bodyCaja dataBox2">
                        @forelse ($cajasdata as $caja)
                            <div class="columCaja2">
                                <div class="dataCaja">{{$caja->tienda}}</div>
                                <div class="dataCaja">{{"S/.".number_format($caja->ingreso,2)}}</div>
                                <div class="dataCaja">{{"S/.".number_format($caja->egreso,2)}}</div>
                                <div class="dataCaja">{{"S/.".number_format($caja->saldo,2)}}</div>
                                <div class="dataCaja">{{"S/.".number_format($caja->total,2)}}</div>
                                <div class="dataCaja">{{$caja->nombre}}</div>
                                <div class="dataCaja">{!! strftime($caja->created_at, strtotime( date('Y-m-d') )) !!}</div>
                                @if (detectarPrivacidad("eliminar","caja",$config,auth()->user()->role))
                                    <a class="dropdown-item eliminar danger" tabla="cashbox" iditem="{{$caja->id}}">
                                        <i class="fa fa-trash"></i>Eliminar
                                    </a>
                                @endif
                            </div>
                        @empty
                        @endforelse


                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="tab-pane animated fadeIn text-muted" id="tab6" aria-expanded="false"></div> --}}
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
    .tablaCajaChica{
        display: grid;
        grid-template-columns: 100%;
    }
    .cabeceraCaja{
        display: grid;
        grid-template-columns: 14% 14% 14% 14% 14% 15% 15%;
    }
    .columCaja{
        display: grid;
        grid-template-columns: 14% 14% 14% 14% 14% 15% 15%;
        align-items: center;
        justify-items: center;
    }
    .cabeceraCaja2{
        display: grid;
        grid-template-columns: repeat(8, 12.5%);
    }
    .columCaja2{
        display: grid;
        grid-template-columns: repeat(8, 12.5%);
        align-items: center;
        justify-items: center;
    }
    .columCaja:hover{
        background-color: yellow;
    }
    .columCaja2:hover{
        background-color: yellow;
    }
    .bodyCaja{
        display: grid;
        grid-template-columns: 100%;
    }
    .dataCaja{
        margin: 10px auto;
    }

</style>


@endsection
