@extends('layouts.backend.plantilla')

@section('contenido1')

<div class="contenedorVentas black">

    <div class="ventaAhora black" style="height:100%;position: absolute;">
        <div class="clientesDiv divMovilProductos">
            <form class="form-horizontal" id="formularioDniCliente" method="POST" action="{{route('dni.cliente')}}">
                @csrf
                <input type="text" name="dni" class="form-control nombreCliente" nombrecliente="" placeholder="DNI del cliente" value="" onkeypress="return filterFloat2(event,this);">
            </form>
            <button class="btn btn-fw primary btnConfigCliente agregarCliente">Agregar</button>
        </div>
        <div class="listaVentas"  style="overflow-y: scroll;overflow: hidden;overflow-y: scroll;">

        </div>

        <div class="clearfix" style="margin-bottom: 10px">
            <div class="dispositivoEscritorio btn-group pull-right">
                @if (detectarPrivacidad("crear","ventas",$config,auth()->user()->role))
                <ul class="nav navbar-nav m-r">
                    <li class="nav-item">
                        <a class="actCobro" total="" iditem="">
                            <span class="btn success rounded" style="padding: 10px 12px">
                                <i class="fa fa-check"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                @endif
            </div>
            <div class="dispositivoEscritorio btn-group pull-right">
                <ul class="nav navbar-nav m-r">
                    <li class="nav-item dropup">
                        <a class="" data-toggle="dropdown">
                            <span class="btn blue rounded" style="padding: 10px 12px">
                                <i class="fa  fa-archive"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu text-color pull-right" role="menu">
                           {{--  @if (detectarPrivacidad("eliminar","ventas",$config,auth()->user()->role))
                              <a class="dropdown-item eliminarVenta" iditem="">
                                <i class="fa fa-trash"></i>
                                Eliminar Venta
                              </a>
                            @endif --}}
                          <a class="dropdown-item cancelarVenta">
                            <i class="fa fa-close"></i>
                            Cancelar Venta
                          </a>
                          {{-- <a class="dropdown-item">
                            <i class="fa fa-usd"></i>
                            Realizar descuento
                          </a> --}}
                        </div>
                    </li>
                </ul>
            </div>
            <span class="dispositivoEscritorio text-sm text-success pull-left m-l totalCVenta" style="font-size: 20px;font-weight: bold;margin-top: 5px;">Total: S/.0.00</span>
            <div class="dispositivoMovil">
                <div class="btn-group divMovilProductos">
                    <span class="text-sm text-success pull-left m-l totalCVenta2" style="font-size: 20px;font-weight: bold;margin-top: 5px;">S/.0.00</span>
                </div>
                <div class="btn-group divMovilProductos pull-right">
                    <ul class="nav navbar-nav m-r">
                        <li class="nav-item dropup">
                            <a class="" data-toggle="dropdown">
                                <span class="btn blue rounded" style="padding: 10px 12px">
                                    <i class="fa  fa-archive"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu text-color pull-right" role="menu">

                              <a href="{{route('welcome')}}" class="dropdown-item cancelarVenta" style="padding:20px">
                                <i class="fa fa-sign-out"></i>
                                Salir de caja
                              </a>
                              <a class="dropdown-item verCajaChica" data-toggle="modal" data-target="#modal-caja" style="padding:20px">
                                <i class="fa fa-usd"></i>
                                Ver caja chica
                              </a>
                              <a class="dropdown-item cancelarVenta" style="padding:20px">
                                <i class="fa fa-close"></i>
                                Cancelar Venta
                              </a>
                              {{-- <a class="dropdown-item">
                                <i class="fa fa-usd"></i>
                                Realizar descuento
                              </a> --}}
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="btn-group divMovilProductos">
                    <ul class="nav navbar-nav m-r">
                        <li class="nav-item">
                            <a class="verProductos2">
                                <span class="btn warn rounded" style="padding: 10px 12px">
                                    <i class="fa  fa-cube"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="btn-group divMovilProductos">
                    <ul class="nav navbar-nav m-r">
                        <li class="nav-item">
                            <a class="verVentas2">
                                <span class="btn warning rounded" style="padding: 10px 12px">
                                    <i class="fa fa-database"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="btn-group divMovilProductos">
                    <ul class="nav navbar-nav m-r">
                        <li class="nav-item">
                            <a class="actCobro" total="" iditem="">
                                <span class="btn success rounded" style="padding: 10px 12px">
                                    <i class="fa fa-check"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- retornar a caja --}}
            <div class="regresarCaja" style="display: none;padding: 5px;">
                <div class="btn-group">
                    <ul class="nav navbar-nav m-r">
                        <li class="nav-item">
                            <a class="regresarACaja">
                                <span class="btn info rounded" style="padding: 10px 17px">
                                    <i class="fa fa-angle-left"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="regresarCaja" style="display: none;padding: 5px;">
                <div class="btn-group">
                    <ul class="nav navbar-nav m-r">
                        <li class="nav-item">
                            <a class="agrandarCaja" agrandado="no">
                                <span class="btn info rounded" style="padding: 10px 14px">
                                    <i class="fa fa-expand"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
    <div class="ventaData black"  style="height:100%;position: absolute;right: 0px;">
        <div>
            <div class="filtrosVentas divForm filtroDataProductos" style="display:none;">

                <select class="form-control catBuscarProd m-b">
                    <option style="color:black" value="0">Selecciona categoria</option>
                    @forelse ($cats as $cat)
                        <option value="{{$cat->id}}" style="color:black">{{$cat->nombre}}</option>
                    @empty
                    @endforelse
                </select>
                <select class="form-control subBuscarProd m-b">
                    <option style="color:black" value="0">Selecciona subcategoria</option>
                    @forelse ($subs as $sub)
                        <option value="{{$sub->id}}" style="color:black">{{$sub->nombre}}</option>
                    @empty
                    @endforelse
                </select>
                <select class="form-control brandBuscarProd m-b">
                    <option style="color:black" value="0">Selecciona marca</option>
                    @forelse ($brands as $brand)
                        <option value="{{$brand->id}}" foto="{{$brand->foto}}" style="color:black">{{$brand->nombre}}</option>
                    @empty
                    @endforelse
                </select>
                <div class="buscadorProductos">
                    <input type="text" class="form-control dniBuscarProd" placeholder="Buscar productos" style="color:white" value="">
                    <button class="btn primary buscarProducto"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="filtrosVentas divForm filtroDataVentas" style="display:none;">
                <div class="form-group">
                    <div class="input-group date">
                      <input type='text' class="form-control buscarFecha" placeholder="ingresa fecha" readonly="">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                      </span>
                    </div>
                </div>
                <select class="form-control buscarCajero m-b">
                    <option value="0" style="color:black">Selecciona cajero</option>
                    @forelse ($cajas as $caja)
                        <option value="{{$caja->responsable}}" style="color:black">{{$caja->cajero}}</option>
                    @empty
                    @endforelse

                </select>
                <div class="buscadorProductos">
                    <input type="text" class="form-control buscarImei" placeholder="Buscar por IMEI" style="color:white" value="">
                </div>
                <div class="buscadorProductos">
                    <input type="text" class="form-control dniBuscarVent" placeholder="Buscar por DNI" style="color:white" value="">
                    <button class="btn primary buscarVenta"><i class="fa fa-search"></i></button>
                </div>
            </div>

        </div>
        <div class="listaProductos" style="overflow-y: scroll;background-color:black;">

        </div>
        <div class="filtrosVentas">
            @if (detectarPrivacidad("crear","gastos",$config,auth()->user()->role))
                <button class="dispositivoEscritorio btn btn-fw danger" data-toggle="modal" data-target="#modal-gastos">Gasto</button>
            @endif
            <button class="dispositivoEscritorio btn btn-fw warn verProductos">Productos</button>
            <button class="dispositivoEscritorio btn btn-fw warning verVentas">Ventas</button>
            <button class="dispositivoEscritorio btn btn-fw success verCajaChica" data-toggle="modal" data-target="#modal-caja">Caja chica</button>

        </div>
    </div>
</div>





<div id="modal-infoproducto" class="modal" data-backdrop="true" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content info">
            <div class="modal-header">
                <h5 class="modal-title">Información del producto</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="row no-gutter">
                    <h4>Nombre:</h4>
                    <p class="nombreProdModal"></p>
                </div>
                <div class="row no-gutter">
                    <h4>Descripcion:</h4>
                    <p class="descripcionProdModal"></p>
                </div>
                <div class="row no-gutter">
                    <h4>Categorias:</h4>
                    <div class="catsProdModal" style="display: grid; grid-template-columns:repeat(5, 1fr);align-items: center;">
                    </div>
                </div>
                <div class="row no-gutter">
                    <h4>Subcategorias:</h4>
                    <div class="subsProdModal" style="display: grid; grid-template-columns:repeat(5, 1fr);align-items: center;">
                    </div>
                </div>
                <div class="row no-gutter grupoDeImeis">
                    <h4>Imei:</h4>
                    <div class="imeiProdModal" style="display: grid; grid-template-columns:repeat(5, 1fr);align-items: center;">
                    </div>
                </div>
                <h4>Marca:</h4>
                <div class="row no-gutter" style="display:grid;grid-template-columns: 100%;align-items:center;justify-items: center;margin-bottom: 20px;">
                    <img class="marcaLogoProdsModal" src="" style="width: 100%;padding: 0px 20%;">
                    <srong class="marcaProdModal warning" style="padding: 0px 20%;"></srong>
                </div>
                <h4>Datos del producto</h4>
                <div style="display: grid; grid-template-columns:repeat(2, 50%);">
                    <div class="row no-gutter">
                        <h6>Tipo de producto:</h6>
                        <p class="tipoProdModal"></p>
                    </div>
                    <div class="row no-gutter">
                        <h6>Tipo de precio:</h6>
                        <p class="tipoPrecioProdModal"></p>
                    </div>
                </div>
                <h4>Precio por menú</h4>
                <div style="display: grid; grid-template-columns:repeat(2, 50%);">
                    <div class="row no-gutter">
                        <h6>Costo por menor:</h6>
                        <p class="costoProdModal"></p>
                    </div>
                    <div class="row no-gutter">
                        <h6>Precio por menor:</h6>
                        <p class="precioProdModal"></p>
                    </div>
                </div>
                <h4>Precio por mayor</h4>
                <div style="display: grid; grid-template-columns:repeat(2, 50%);">
                    <div class="row no-gutter">
                        <h6>Mínimo para precio por mayor:</h6>
                        <p class="cantMayorProdModal"></p>
                    </div>
                    <div class="row no-gutter">
                        <h6>Precio por mayor:</h6>
                        <p class="precioProdModal"></p>
                    </div>
                </div>
                <div class="row no-gutter" style="display:grid;grid-template-columns:100%;padding-bottom: 20px;">
                    <h4>Imagen:</h4>
                    <img class="fotoProdModal" src="" style="width:100%">
                </div>
                <h4>Galeria:</h4>
                <div class="row no-gutter multimediaProdModal" style="display:grid;grid-template-columns: 50% 50%;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-preciovariable" class="modal modal-preciovariable" data-backdrop="true" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content success">
            <div class="modal-header">
                <h5 class="modal-title">Caja chica</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="form-control-label">Determinar precio personalizado:</label>
                    <div>
                        <input type="number" class="form-control precioCambiante" autocomplete="nope" placeholder="Precio referencial S/.5.00" value="" onkeypress="return filterFloat(event,this);">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md cambiarPrecioProducto" data-dismiss="modal">Determinar precio</button>
                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-cantidadpersonalizada" class="modal" data-backdrop="true" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content success">
            <div class="modal-header">
                <h5 class="modal-title">Cantidad de producto</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="row no-gutter" >
                    <div class="form-group row" condicion="" busqueda="" style="">
                        <label class="col-lg-2 form-control-label">Cantidad:</label>
                        <div class="col-lg-8">
                            <input type="number" idProd="" class="form-control personCantidad" placeholder="Escribir la cantidad que deseas" value="" onkeypress="return filterFloat2(event,this);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn dark-white p-x-md warning actualizarCantidad">Actualizar Cantidad</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-caja" class="modal" data-backdrop="true" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content success">
            <div class="modal-header">
                <h5 class="modal-title">Caja chica</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="row no-gutter" style="display: grid; grid-template-columns: repeat(2, 50%);grid-column-gap: 10px;grid-template-rows: repeat(2, 50%);grid-row-gap: 10px;">
                    <div class="b-r b-b" style="background-color:white;border-radius: 15PX;">
                        <div class="" style="background-color:white;border-radius: 15PX;display:grid;align-items: center;justify-items: center;">
                            <div class="text-center">
                                <h2 class="text-center _600 datoIngreso" style="color:black">S/.0.00</h2>
                                <p class="warning">Ingresos</p>
                            </div>
                        </div>
                    </div>
                    <div class="b-r b-b" style="background-color:white;border-radius: 15PX;">
                        <div class="" style="background-color:white;border-radius: 15PX;display:grid;align-items: center;justify-items: center;">

                            <div class="text-center">
                                <h2 class="text-center _600 datoEgreso" style="color:black">S/.0.00</h2>
                                <p class="danger">Egresos</p>

                            </div>
                        </div>
                    </div>
                    <div class="b-r b-b" style="background-color:white;border-radius: 15PX;">
                        <div class="" style="background-color:white;border-radius: 15PX;display:grid;align-items: center;justify-items: center;">

                            <div class="text-center">
                                <h2 class="text-center _600 datoSaldo" style="color:black">S/.0.00</h2>
                                <p class="warning">Monto inicial</p>

                            </div>
                        </div>
                    </div>
                    <div class="b-b" style="background-color:white;border-radius: 15PX;">
                        <div class="" style="background-color:white;border-radius: 15PX;display:grid;align-items: center;justify-items: center;">

                            <div class="text-center">
                                <h2 class="text-center _600 datoTotal" style="color:black">S/.0.00</h2>
                                <p class="success">Total</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group row">
                    <div class="m-t" style="padding:0px 20px">
                        <form class="form-horizontal" id="cerrarCajaForm" method="POST" action="{{route('cashboxes.cerrar')}}">
                            @csrf
                            <button class="btn danger btn-lg p-x-md btn-block cerrarCaja" style="font-weight: bold;margin:20px 0px">Cerrar caja</button>
                        </form>
                        <button type="button" class="btn dark-white btn-lg p-x-md btn-block" data-dismiss="modal" style="margin:20px 0px">Cerrar ventana</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (detectarPrivacidad("crear","gastos",$config,auth()->user()->role))
    @include('layouts.backend.modals.gastos-caja',['title' => 'Agregar Gasto','url' => route('spends.store'),'modal' => 'gastos'])
@endif

@if (detectarPrivacidad("crear","ventas",$config,auth()->user()->role))
    <div id="modal-cobrar" class="modal" data-backdrop="true" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content success">
                <div class="modal-header _600">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    Cobrar Pedido
                </div>
                <div class="modal-body">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tablaCobroDiv m-b" style="margin-right: 0px">

                        <table class="table-bordered table-condensed" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <td width="20%" style="border-right-color: #FFF !important;"> <strong> Cantidad</strong></td>
                                    <td width="50%" class="text-left"><strong> Producto</strong></td>
                                    <td width="15%" style="border-right-color: #FFF !important;"><strong> Precio Unitario</strong></td>
                                    <td width="15%" class="text-right"><strong> Total</strong></td>
                                </tr>
                            </thead>
                            <tbody class="cuadroProductos">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="border-color: #FFF;border-right-width: 0px;border-top-width: 0px;"><strong>Adelanto</strong></td>
                                    <td style="border-color: #FFF;border-top-width: 0px;border-left-width: 0px;border-right-width: 0px;" class="text-right"><span id=""></span></td>
                                    <td style="border-color: #FFF;border-top-width: 0px;border-left-width: 0px;border-right-width: 0px;"></td>
                                    <td style="border-color: #FFF;" class="text-right"><strong id="adcobro">-0.00</strong></td>
                                </tr>
                                 <tr>
                                    <td style="border-color: #FFF;border-right-width: 0px;"><strong>Subtotal</strong></td>
                                    <td style="border-color: #FFF;border-left-width: 0px;border-right-width: 0px;" class="text-right"><span id=""></span></td>
                                    <td style="border-color: #FFF !important;border-left-width: 0px;"></td>
                                    <td style="border-color: #FFF;" class="text-right"><strong class="totalCobroTd">0.00</strong></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="m-t">
                            <div class="btnsOpcCobro" style="padding-right: 0px;padding-left: 0px;">
                                <a style="color:white" class="btn btn-outline b-white notaAct">Nota</a>
                                <a style="color:white" class="btn btn-outline b-white dctoAct">DCTO</a>
                                <a style="color:white" class="btn btn-outline b-white cardAct">Tarjeta</a>
                                <a style="color:white" class="btn btn-outline b-white efectAct">Efectivo</a>
                                <a style="color:white" class="btn btn-outline b-white exacAct">Exacto</a>
                            </div>
                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 descuentoDiv" act="no" style="margin-top: 10px;display: none;">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding: 0px">
                                <label style="font-size: 15px; font-weight: bold;margin-top: 20px">Descuento</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding: 0px;">
                                <input type="text" style="margin-top: 10px" class="form-control descuentoInput formatoPrecio" value="0" onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>

                        <div class="form-group row codTarjetaDiv" style="display: none;">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="col-lg-12 form-control-label col-md-12 col-sm-12 col-xs-12">Código de pago:</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <input type="text" class="form-control bancoInput">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row notaDiv" act="no" style="display: none;">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="col-lg-12 form-control-label col-md-12 col-sm-12 col-xs-12">Código de pago:</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <textarea rows="3"  class="form-control notaInput">
                                    </textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 monedasDiv" style="display: none;">
                        <p class="btn-groups" style="margin-bottom: 0px">
                            </p><div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: white" class="btn btn-fw danger col-lg-12 col-md-12 col-sm-12 col-xs-12 limpiarBilletes">Limpiar</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw lime-A200 col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="0.1">S/.0.10</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw lime-A200 col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="0.2">S/.0.20</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw lime-A200 col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="0.5">S/.0.50</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="1">S/.1.00</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="2">S/.2.00</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="5">S/.5.00</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="10">S/.10.00</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="20">S/.20.00</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="50">S/.50.00</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="100">S/.100.00</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4" style="padding: 1px">
                                <a style="color: black" cantidad="0" class="btn monedaCambio btn-fw warning col-lg-12 col-md-12 col-sm-12 col-xs-12" valor="200">S/.200.00</a>
                            </div>
                        <p></p>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 vueltoDiv" style="margin-top: 10px; display: none;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="">
                            <label class="pull-right" style="font-size: 25px; font-weight: bold;margin-top: 10px">Vuelto</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="">
                            <label class="pull-left valorVuelto" valor="0" style="font-size: 25px; font-weight: bold;margin-top: 10px">S/. 0.00</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="m-t dibBtnCobrar" style="display: none;">
                            <button class="btn danger btn-lg p-x-md btn-block cobrarPedido" valor="20" style="font-weight: bold;">Pagar S/. 0.00</button>
                        </div>
                    </div>

                    <form class="form-horizontal" id="formularioCobro" method="POST" action="{{route('sales.store')}}">
                        @csrf
                        <input type="hidden" class="idventa" name="id">
                        {{-- <input type="hidden" class="trabajador" name="trabajador"> --}}
                        {{-- <input type="hidden" class="caja" name="caja"> --}}
                        <input type="hidden" class="cliente" name="cliente">
                        <input type="hidden" class="cod_pago" name="cod_pago">
                        <input type="hidden" class="nota" name="nota">
                        <input type="hidden" class="tipo" name="tipo">
                        <input type="hidden" class="pedido" name="pedido">
                        <input type="hidden" class="tipo_descuento" name="tipo_descuento">
                        <input type="hidden" class="subtotal" name="subtotal">
                        <input type="hidden" class="descuento" name="descuento">
                        <input type="hidden" class="igv" name="igv">
                        <input type="hidden" class="vuelto" name="vuelto">
                        <input type="hidden" class="total" name="total">

                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@if (detectarPrivacidad("crear","clientes",$config,auth()->user()->role))
    @include('layouts.backend.modals.clientes',['title' => 'Agregar Cliente','url' => route('clients.store'),'modal' => 'clients'])
@endif

<div class="modal fade" id="modal-cerrar-caja">
  <div class="modal-dialog modal-lg" style="top: 30%;">
      <div class="modal-content danger">
          <div class="modal-header _600">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="eliminarContenedor" style="display:grid;grid-template-columns: 100%;align-items: center;justify-items: center;text-align: center;">
                <p style="font-size:20px">Al hacer click en cerrar se reiniciara la caja y no podras regresar atras ¿Estas seguro que quieres cerrarla?</p>
                <div class="botonesEliminar">
                  <button class="btn btn-fw accent eliminarNoGracias" >No gracias</button>
                  <button class="btn btn-fw danger eliminarSiGracias" >Sí</button>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>


<script type="text/javascript">

    altmaxa = $(".ventaAhora").height();
    $(".ventaAhora").css("max-height",altmaxa).css("min-height",altmaxa).css("position","")
    $(".ventaData").css("max-height",altmaxa).css("min-height",altmaxa).css("position","")
    // if (i==1) {
    //         altura = $($(".verImagenModal")[0]).height()
    //         $(".verImagenModal").height(altura)
    //     }
    // $(".listaProductos").css("max-height",altoPantalla).css("min-height",altoPantalla+"px")
    function vistaCaja() {
        imagenes = $(".verImagenModal");
        if (imagenes.length>1) {
            altura = $($(".verImagenModal")[0]).height()
            $(".verImagenModal").height(altura)
        }
    }
    setInterval(vistaCaja, 1000);
</script>

<style type="text/css">

    .ventaAhora{
        display: grid;
        grid-template-rows: 10% 80% 10%;
        float: left;
        /*align-items: initial;*/

    }
    .ventaData{
        float: right;
    }
    .contenedorVentas{
        display: grid;
        grid-auto-rows: 100%;
    }
    .clientesDiv{
        display: grid;
        grid-template-columns: auto auto;
        margin-top: 10px;
        padding: 10px;
    }


    .listaProductos{
        display: grid;
        grid-auto-rows: minmax(15%,20%);
        align-items: initial;
    }
    .DetallesProd{
        display: grid;
        grid-template-columns: auto auto;
        column-gap: 15px;
    }
    .botonesProductos{
        display: grid;
        padding: 10px;
        grid-template-columns: auto auto;
    }
    .productoCuadro{
        display: grid;
        grid-template-columns: 100%;
        grid-template-rows: repeat(4, auto);
        padding: 10px;
        text-align: center;
        align-items: center;
        justify-items: center;
    }
    .filtrosVentas{
        display: grid;
        column-gap: 2%;
        padding: 10px;
    }
    .buscadorProductos{
        display: grid;
        grid-template-columns: auto auto;
        grid-template-rows: 40px;
    }


    @media (min-width:1200px){
        .btnsOpcCobro{
            display: grid;
            grid-template-columns: repeat(5, 1fr);
        }
        .contenedorVentas{
            grid-template-columns: 25% 75%;
        }
        .ventaData{
            display: grid;
            grid-template-rows: 10% 80% 10%;
            float: right;
            /*align-items: ;*/
        }
        .dispositivoMovil{
            display: none;
        }

        .listaProductos{
            grid-template-columns: repeat(6, 16%);
        }

        .filtrosVentas{
            grid-template-columns: repeat(4, auto);
        }

        .listaVentas{
            margin-top: 0px;
        }

        .listaProdsCaja{
            display: none;
        }

        .listaProdsCajaEscritorio{
            display: block;
        }

        .white{
            display: none;
            background-color: black;
        }

        .app-header{
            display: none;
        }

        .listaPM{
            display: none;
        }
        .listaProdsCajaMovil .listaPE{
            display: block;
        }
        .listaProdsCajaEscritorio .listaPE{
            display: block;
        }

        .tituloTablaVentas{
            display: grid;
            grid-template-columns: 15% 22% 15% 12% 12% 12% 12%;
        }
        .datoVentaTb{
            display: grid;
            grid-template-columns: 15% 22% 15% 12% 12% 12% 12%;
            align-items: center;
            justify-items: center;
        }

    }

    @media (max-width:1199px) and (min-width:992px){
        .btnsOpcCobro{
            display: grid;
            grid-template-columns: repeat(5, 1fr);
        }

        .contenedorVentas{
            grid-template-columns: 25% 75%;
        }
        .ventaData{
            display: grid;
            grid-template-rows: 10% 80% 10%;
            float: right;
            /*align-items: ;*/
        }
        .dispositivoMovil{
            display: none;
        }

        .listaProductos{
            grid-template-columns: repeat(5, 20%);
        }

        .filtrosVentas{
            grid-template-columns: repeat(4, auto);
        }

        .listaVentas{
            margin-top: 0px;
        }

        .listaProdsCaja{
            display: none;
        }

        .listaProdsCajaEscritorio{
            display: block;
        }

        .white{
            display: none;
            background-color: black;
        }

        .app-header{
            display: none;
        }

        .listaPM{
            display: none;
        }
        .listaProdsCajaMovil .listaPE{
            display: block;
        }
        .listaProdsCajaEscritorio .listaPE{
            display: block;
        }

        .tituloTablaVentas{
            display: grid;
            grid-template-columns: 15% 22% 15% 12% 12% 12% 12%;
        }
        .datoVentaTb{
            display: grid;
            grid-template-columns: 15% 22% 15% 12% 12% 12% 12%;
            align-items: center;
            justify-items: center;
        }
    }

    @media (max-width:991px) and (min-width:768px){
        .btnsOpcCobro{
            display: grid;
            grid-template-columns: repeat(2, 50%);
        }
        .contenedorVentas{
            grid-template-columns: 100%;
        }
        .ventaData{
            display: none;
        }
        .dispositivoMovil{
            display: grid;
            grid-template-columns: 40% 15% 15% 15% 15%;
        }
        .dispositivoEscritorio{
            display: none;
        }

        .listaProductos{
            grid-template-columns: repeat(4, 25%);
        }

        .filtrosVentas{
            grid-template-columns: repeat(2, auto);
        }

        .listaVentas{
            margin-top: 20px;
        }

        .listaProdsCaja{
            display: grid;
        }

        .listaProdsCajaEscritorio{
            display: block;
        }

        .white{
            display: block;
            /*background-color: black;*/
        }

        .app-header{
            display: none;
        }

        .listaProdsCajaMovil .listaPM{
            display: block;
        }
        .listaProdsCajaMovil .listaPE{
            display: none;
        }
        .listaProdsCajaEscritorio .listaPE{
            display: block;
        }
        .listaProdsCajaEscritorio .listaPM{
            display: none;
        }

        .tituloTablaVentas{
            display: grid;
            grid-template-columns: 15% 22% 15% 12% 12% 12% 12%;
        }
        .datoVentaTb{
            display: grid;
            grid-template-columns: 15% 22% 15% 12% 12% 12% 12%;
            align-items: center;
            justify-items: center;
        }
    }

    @media (max-width:767px){
        .btnsOpcCobro{
            display: grid;
            grid-template-columns: repeat(2, 50%);
        }
        .contenedorVentas{
            grid-template-columns: 100%;
        }
        .ventaData{
            display: none;
        }
        .dispositivoMovil{
            display: grid;
            grid-template-columns: 40% 15% 15% 15% 15%;
        }
        .dispositivoEscritorio{
            display: none;
        }

        .listaProductos{
            grid-template-columns: repeat(2, 50%);
        }

        .filtrosVentas{
            grid-template-columns: repeat(2, auto);
        }

        .listaVentas{
            margin-top: 20px;
        }

        .listaProdsCaja{
            display: grid;
        }

        .listaProdsCajaEscritorio{
            display: grid;
        }

        .white{
            display: block;
            /*background-color: black;*/
        }

        .app-header{
            display: none;
        }

        .listaProdsCajaMovil .listaPM{
            display: block;
        }
        .listaProdsCajaMovil .listaPE{
            display: none;
        }
        .listaProdsCajaEscritorio .listaPE{
            display: block;
        }
        .listaProdsCajaEscritorio .listaPM{
            display: none;
        }

        .tituloTablaVentas{
            display: grid;
            grid-template-columns: 30% 30% 20% 20%;
        }
        .datoVentaTb{
            display: grid;
            grid-template-columns: 30% 30% 20% 20%;
            align-items: center;
            justify-items: center;
        }
        .ocultarMovil{
            display: none;
        }
    }

</style>

<style type="text/css">
    .tablaVentasPersonalizada{
        display: grid;
        /*width: 950px;*/
    }

    .tablaAgrandada{
        display: grid;
        /*width: 950px;*/
    }

    .datoVentaTb:hover {
        background-color: yellow;
        color: black;
    }
</style>

<script type="text/javascript">
    function tamañotabla() {
        ancho = $(".listaProductos").width();
        $(".tablaVentasPersonalizada").width(ancho);
    }
    setInterval('tamañotabla()',1000);
</script>

@endsection

