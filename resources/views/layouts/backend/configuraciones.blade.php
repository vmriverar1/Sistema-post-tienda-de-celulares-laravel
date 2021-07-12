@extends('layouts.backend.plantilla')

@section('contenido1')
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<!-- bootstrap color picker https://farbelous.github.io/bootstrap-colorpicker/v2/-->
<script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>

@include('layouts.backend.partes.estilos')
<div class="app-body">
    <div class="row-col">
      <div class="col-sm-3 col-lg-2 b-r">
        <div class="p-y">
          <div class="nav-active-border left b-primary">
            <ul class="nav nav-sm">
              <li class="nav-item">
                <a class="nav-link block active"  data-toggle="tab" data-target="#tab-1">Plantilla</a>
              </li>
              <li class="nav-item">
                <a class="nav-link block"  data-toggle="tab" data-target="#tab-2">Menú</a>
              </li>
              <li class="nav-item">
                <a class="nav-link block"  data-toggle="tab" data-target="#tab-3">Acciones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link block"  data-toggle="tab" data-target="#tab-4">Caja</a>
              </li>
              <li class="nav-item">
                <a class="nav-link block"  data-toggle="tab" data-target="#tab-5">Seguridad</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-9 col-lg-10 light bg">
        <div class="tab-content pos-rlt">

            <div class="tab-pane active" id="tab-1">
                <div class="p-a-md b-b _600">Configuración de plantilla</div>

            </div>



            <div class="tab-pane" id="tab-2">

                <div class="p-a-md b-b _600">Menú</div>

                <div class="p-a-md col-md-12 recolectoresPadres" array='{{$config->menu}}' input="menuInput">
                    @for($i=0; $i < count($titulosmenu); $i++)
                        <div>
                            <label>{{$titulosmenu[$i]}}</label>
                            <div class="clearfix m-b nav-active-success">
                                <ul class="nav nav-pills recolectorData" array='{{stringArrConfig($config->menu,$tipos1[$i])}}' data-ui-nav="" tipo="{{$tipos1[$i]}}">
                                    @for($a=0; $a < count($usuarios); $a++)
                                        <li class="nav-item detectorPuesto
                                        @if (detectarPrivacidad("menu",$tipos1[$i],$config,$usuariosbd[$a]))
                                            active
                                        @endif
                                        "><a class="nav-link" role="{{$usuariosbd[$a]}}">{{$usuarios[$a]}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endfor

                </div>
                <form role="form" class="p-a-md col-md-12" method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <input type="hidden" class="menuInput" name="menu" value="{{$config->menu}}">
                    <input type="hidden" class="crearInput" name="crear" value="{{$config->crear}}">
                    <input type="hidden" class="editarInput" name="editar" value="{{$config->editar}}">
                    <input type="hidden" class="eliminarInput" name="eliminar" value="{{$config->eliminar}}">
                    <input type="hidden" class="plantillaInput" name="plantilla" value="{{$config->plantilla}}">
                    <input type="hidden" class="otrosInput" name="otros" value="{{$config->otros}}">
                    <input type="hidden" class="cajaInput" name="caja" value="{{$config->caja}}">
                    <input type="hidden" class="productosInput" name="productos" value="{{$config->productos}}">
                    <button type="submit" class="btn btn-info m-t actualizarSettings">Guardar</button>
                </form>
            </div>
            <div class="tab-pane" id="tab-3">
                <div class="p-a-md b-b _600">Acciones</div>
                <div class="p-a-md col-md-12 recolectoresPadres" array='{{$config->crear}}' input="crearInput">
                    @for($i=0; $i < count($titulosmenu2); $i++)
                        <div>
                            <label>{{$titulosmenu2[$i]}}</label>
                            <div class="clearfix m-b nav-active-success">
                                <ul class="nav nav-pills recolectorData" array='{{stringArrConfig($config->crear,$tipos1[$i])}}' data-ui-nav="" tipo="{{$tipos2[$i]}}">
                                    @for($a=0; $a < count($usuarios); $a++)
                                        <li class="nav-item detectorPuesto
                                        @if (detectarPrivacidad("crear",$tipos2[$i],$config,$usuariosbd[$a]))
                                            active
                                        @endif
                                        "><a class="nav-link" role="{{$usuariosbd[$a]}}">{{$usuarios[$a]}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endfor
                </div>
                <form role="form" class="p-a-md col-md-12" method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <input type="hidden" class="menuInput" name="menu" value="{{$config->menu}}">
                    <input type="hidden" class="crearInput" name="crear" value="{{$config->crear}}">
                    <input type="hidden" class="editarInput" name="editar" value="{{$config->editar}}">
                    <input type="hidden" class="eliminarInput" name="eliminar" value="{{$config->eliminar}}">
                    <input type="hidden" class="plantillaInput" name="plantilla" value="{{$config->plantilla}}">
                    <input type="hidden" class="otrosInput" name="otros" value="{{$config->otros}}">
                    <input type="hidden" class="cajaInput" name="caja" value="{{$config->caja}}">
                    <input type="hidden" class="productosInput" name="productos" value="{{$config->productos}}">
                    <button type="submit" class="btn btn-info m-t actualizarSettings">Guardar</button>
                </form>
                <div class="p-a-md col-md-12 recolectoresPadres" array='{{$config->editar}}' input="editarInput">
                    @for($i=0; $i < count($titulosmenu3); $i++)
                        <div>
                            <label>Editar {{$titulosmenu3[$i]}}</label>
                            <div class="clearfix m-b nav-active-success">
                                <ul class="nav nav-pills recolectorData" array='{{stringArrConfig($config->editar,$tipos1[$i])}}' data-ui-nav="" tipo="{{$tipos2[$i]}}">
                                    @for($a=0; $a < count($usuarios); $a++)
                                        <li class="nav-item detectorPuesto
                                        @if (detectarPrivacidad("editar",$tipos2[$i],$config,$usuariosbd[$a]))
                                            active
                                        @endif
                                        "><a class="nav-link" role="{{$usuariosbd[$a]}}">{{$usuarios[$a]}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endfor

                </div>
                <form role="form" class="p-a-md col-md-12" method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <input type="hidden" class="menuInput" name="menu" value="{{$config->menu}}">
                    <input type="hidden" class="crearInput" name="crear" value="{{$config->crear}}">
                    <input type="hidden" class="editarInput" name="editar" value="{{$config->editar}}">
                    <input type="hidden" class="eliminarInput" name="eliminar" value="{{$config->eliminar}}">
                    <input type="hidden" class="plantillaInput" name="plantilla" value="{{$config->plantilla}}">
                    <input type="hidden" class="otrosInput" name="otros" value="{{$config->otros}}">
                    <input type="hidden" class="cajaInput" name="caja" value="{{$config->caja}}">
                    <input type="hidden" class="productosInput" name="productos" value="{{$config->productos}}">
                    <button type="submit" class="btn btn-info m-t actualizarSettings">Guardar</button>
                </form>
                <div class="p-a-md col-md-12 recolectoresPadres"  array='{{$config->eliminar}}' input="eliminarInput">
                    @for($i=0; $i < count($titulosmenu3); $i++)
                        <div>
                            <label>Eliminar {{$titulosmenu3[$i]}}</label>
                            <div class="clearfix m-b nav-active-success">
                                <ul class="nav nav-pills recolectorData" array='{{stringArrConfig($config->eliminar,$tipos1[$i])}}' data-ui-nav="" tipo="{{$tipos2[$i]}}">
                                    @for($a=0; $a < count($usuarios); $a++)
                                        <li class="nav-item detectorPuesto
                                        @if (detectarPrivacidad("eliminar",$tipos2[$i],$config,$usuariosbd[$a]))
                                            active
                                        @endif
                                        "><a class="nav-link" role="{{$usuariosbd[$a]}}">{{$usuarios[$a]}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endfor

                </div>
                <form role="form" class="p-a-md col-md-12" method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <input type="hidden" class="menuInput" name="menu" value="{{$config->menu}}">
                    <input type="hidden" class="crearInput" name="crear" value="{{$config->crear}}">
                    <input type="hidden" class="editarInput" name="editar" value="{{$config->editar}}">
                    <input type="hidden" class="eliminarInput" name="eliminar" value="{{$config->eliminar}}">
                    <input type="hidden" class="plantillaInput" name="plantilla" value="{{$config->plantilla}}">
                    <input type="hidden" class="otrosInput" name="otros" value="{{$config->otros}}">
                    <input type="hidden" class="cajaInput" name="caja" value="{{$config->caja}}">
                    <input type="hidden" class="productosInput" name="productos" value="{{$config->productos}}">
                    <button type="submit" class="btn btn-info m-t actualizarSettings">Guardar</button>
                </form>
            </div>

          <div class="tab-pane" id="tab-4">
            <div class="p-a-md b-b _600">Notifications</div>
            <form role="form" class="p-a-md col-md-6">
              <p>Notice me whenever</p>
              <div class="checkbox">
                <label class="ui-check">
                  <input type="checkbox"><i class="dark-white"></i> Anyone seeing my profile page
                </label>
              </div>
              <div class="checkbox">
                <label class="ui-check">
                  <input type="checkbox"><i class="dark-white"></i> Anyone follow me
                </label>
              </div>
              <div class="checkbox">
                <label class="ui-check">
                  <input type="checkbox"><i class="dark-white"></i> Anyone send me a message
                </label>
              </div>
              <div class="checkbox">
                <label class="ui-check">
                  <input type="checkbox"><i class="dark-white"></i> Anyone invite me to group
                </label>
              </div>
              <button type="submit" class="btn btn-info m-t">Update</button>
            </form>
          </div>
          <div class="tab-pane" id="tab-5">
            <div class="p-a-md b-b _600">Security</div>
            <div class="p-a-md">
              <div class="clearfix m-b-lg">
                <form role="form" class="col-md-6 p-a-0">
                  <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>New Password Again</label>
                    <input type="password" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-info m-t">Update</button>
                </form>
              </div>

              <p><strong>Delete account?</strong></p>
              <button type="submit" class="btn btn-danger m-t" data-toggle="modal" data-target="#modal">Delete Account</button>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection



{{-- modal --}}
{{-- ESTADOS --}}
{{-- @extends('layouts.modalhtml',['title' => 'Agregar Ciudad','url' => route('ciudades.store'),'modal' => 'ciudades'])
@section('contenido2')
    {!! modalEntrada("inputtext","nombre","ciudades","Ciudad","Escribir nombre de ciudad",null,null,null) !!}
    {!! botonModal("ciudades") !!}
@endsection --}}