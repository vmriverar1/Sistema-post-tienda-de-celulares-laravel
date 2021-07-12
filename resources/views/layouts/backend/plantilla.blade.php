<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8"/>
  <title>Backend</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <title>@yield('inicio','Aprendible')</title> --}}
  <meta name="description" content="Responsive, Bootstrap, BS4" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{asset('images/logo.png')}}">

  <!-- style -->
  {{-- <link rel="stylesheet" href="{{asset('css/styles/app.css')}}" type="text/css" /> --}}
  <link rel="stylesheet" href="{{ asset('css/animate.css/animate.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/glyphicons/glyphicons.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/material-design-icons/material-design-icons.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/ionicons/css/ionicons.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/simple-line-icons/css/simple-line-icons.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />

  <!-- build:css css/styles/app.min.css -->
  <link rel="stylesheet" href="{{ asset('css/styles/app.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/styles/style.css')}}" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="{{ asset('css/styles/font.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">


  {{-- <script src="js/app.js"></script> --}}

  <!-- jQuery -->
    {{-- <script src="{{ asset('libs/jquery/dist/jquery.js') }}" defer></script> --}}

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  {{-- sweet alert --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

  <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
  <script src="{{ asset('js/datepicker.js') }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> --}}
  <script src="https://momentjs.com/downloads/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment-with-locales.min.js"></script>
</head>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>
    <div class="app" id="app">
      <!-- aside -->
      @guest
      @else
        @include('layouts.backend.partes.menu')
      @endguest
      {{-- @component('components.alert-component')@endcomponent --}}
      <!-- <aside></aside> -->
      <div id="content" class="app-content box-shadow-z2 pjax-container" role="main">
        <div class="app-body">
          @guest
          @else
            @include('layouts.backend.partes.cabezote')
          @endguest
          <!-- ############ PAGE START-->
          @yield('contenido1')
          <!-- ############ PAGE END-->
        </div>
      </div>
      <!-- modales -->
      <div class="modal fade" id="modal-fotografias">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header _600">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      Nuevo Usuario
                  </div>
                  <div class="modal-body">
                      <form class="form-horizontal">
                          @csrf
                          <div class="form-group row">
                              <label class="col-lg-2 form-control-label">Imágenes:</label>
                              <div class="col-lg-8 imagenesTablas">
                                   <img src="images/default/anonymous.png" class="img-thumbnail previsualizar" width="100%">
                              </div>
                          </div>


                          <div class="form-group row">
                              <div class="col-lg-12 ">
                                  <a class="btn primary btn-lg p-x-md btn-block" data-dismiss="modal">Cerrar</a>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- modales -->
      <div class="modal fade" id="modal-eliminar">
          <div class="modal-dialog modal-lg" style="top: 30%;">
              <div class="modal-content">
                  <div class="modal-header _600">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="eliminarContenedor" style="display:grid;grid-template-columns: 100%;align-items: center;justify-items: center;text-align: center;">
                        <p style="font-size:20px">¿Seguro que quiere eliminar este elemento?</p>
                        <div class="botonesEliminar">
                          <button class="btn btn-fw accent eliminarNoGracias">No gracias</button>
                          <button class="btn btn-fw danger eliminarSiGracias">Sí</button>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      {{-- modal --}}
      <div class="modal fade" id="modal-producto-gasto">
          <div class="modal-dialog modal-lg">
              <div class="modal-content info">
                  <div class="modal-header _600">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      Compras de producto
                  </div>
                  <div class="modal-body">
                      <form class="form-horizontal" id="formularioCompraProuctos" method="POST" action="{{ route('spends.compras') }}" enctype="multipart/form-data" autocomplete="nope">
                          @csrf



                          <div class="form-group row"  style="">
                              <label class="col-lg-2 col-sm-2 col-md-12 col-xs-12 form-control-label">Tipo de comprobante:</label>
                              <div class="col-lg-10 col-sm-10 col-md-12 col-xs-12">
                                  <select name="comprobante" class="form-control  limpiarSpend" value="">
                                      <option value="ninguno">Selecciona una opción</option>
                                      <option value="RECIBO">RECIBO</option>
                                      <option value="FACTURA">FACTURA</option>
                                    </select>
                              </div>
                          </div>

                          <div class="form-group row" style="">
                              <label class="col-lg-2 col-sm-2 col-md-12 col-xs-12 form-control-label">Salida:</label>
                              <div class="col-lg-10 col-sm-10 col-md-12 col-xs-12">
                                  <select name="salida" class="form-control tipodeSalida limpiarSpend" value="">
                                      <option value="ninguno">Selecciona una opción</option><option value="CAJA">Se pagará con dinero en caja</option><option value="BANCO">Se pagara con dinero en banco</option></select>
                              </div>
                          </div>

                          <div class="form-group row" style="">
                              <label class="col-lg-2 col-sm-2 col-md-12 col-xs-12 form-control-label">ID comprobante:</label>
                              <div class="col-lg-10 col-sm-10 col-md-12 col-xs-12">
                                  <input type="text" name="cod_comprobante" class="form-control  limpiarSpend" placeholder="Escribir código de comprobante" value="">
                              </div>
                          </div>

                          <input type="hidden" class="dataCompra" name="productos">
                          {{-- area productos --}}
                          <span style="margin-top:30px"><strong>Productos</strong></span>
                          <div class="" style="display:grid; grid-template-columns: 50% 50%;margin-top: 10px;">

                              <select class="form-control catBuscarProd2 m-b">
                              </select>
                              <select class="form-control subBuscarProd2 m-b">
                              </select>
                              <select class="form-control brandBuscarProd2 m-b">
                              </select>
                              <div class="buscadorProductos" style="display: grid; grid-template-columns: auto auto;margin-bottom:15px;">
                                  <input type="text" class="form-control dniBuscarProd2" placeholder="Buscar productos" style="color:white;" value="">
                                  <a class="btn primary buscarProducto2"><i class="fa fa-search"></i></a>
                              </div>
                          </div>
                          {{-- busqueda de productos --}}
                          <p class="m-b btn-groups busquedaProductosGastos">
                          </p>
                          <a class="btn warning btn-lg p-x-md btn-block limpiarProdsCompra" style="font-weight: bold;margin:20px 0px;display: none;">Limpiar</a>
                          {{-- //productos --}}
                          <div class="productosCompra" style="margin:40px 0px;">
                          </div>

                          {{-- {!! modalEntrada("inputprecio","igv","spend","Igv","Escribir el igv de la venta",null,null,null) !!} --}}
                          <div class="form-group row" condicion="" busqueda="" style="">
                              <label class="col-lg-2 form-control-label">total:</label>
                              <div class="col-lg-8">
                                  <input type="number" columna="total" limpiarSpend name="total" class="form-control  totalCompraProd limpiarspend spend has-value" autocomplete="nope" placeholder="Escribir el pago total de la compra" value="" onkeypress="return filterFloat(event,this);" disabled="">
                              </div>
                          </div>
                          {!! modalEntrada("imagen","foto","spend","Foto recibo",null,null,null,null) !!}


                          <div class="form-group row">
                              <div class="col-lg-12 ">
                                  <button class="btn primary btn-lg p-x-md btn-block guardarCompraProd" id="guardarGastoCompra" style="display: none;">Guardar</button>
                              </div>
                          </div>




                      </form>
                  </div>
              </div>
          </div>
      </div>
      {{-- @extends('layouts.modal') --}}
    </div>

    <style type="text/css">
      .paging_simple_numbers{
        display: none;
      }
      .dataTables_info{
        display: none;
      }
    </style>



    <!-- Bootstrap -->
    <script src="{{ asset('libs/tether/dist/js/tether.min.js') }}" defer></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.js') }}" defer></script>
    <!-- core -->
    <script src="{{ asset('libs/jQuery-Storage-API/jquery.storageapi.min.js') }}" defer></script>
    <script src="{{ asset('libs/PACE/pace.min.js') }}" defer></script>
    <script src="{{ asset('libs/jquery-pjax/jquery.pjax.js') }}" defer></script>
    <script src="{{ asset('libs/blockUI/jquery.blockUI.js') }}" defer></script>

    <script src="{{ asset('scripts/config.lazyload.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-load.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-jp.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-include.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-device.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-form.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-modal.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-nav.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-list.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-screenfull.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-scroll-to.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-toggle-class.js') }}" defer></script>
    <script src="{{ asset('scripts/ui-taburl.js') }}" defer></script>

    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.priceformat.min.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <script src="{{ asset('css/dropzone/dropzone.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.css') }}">
    <!-- bootstrap color picker https://farbelous.github.io/bootstrap-colorpicker/v2/-->
  <script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    @stack("custom-scripts")
    <!-- Dropzone -->

</body>
</html>
