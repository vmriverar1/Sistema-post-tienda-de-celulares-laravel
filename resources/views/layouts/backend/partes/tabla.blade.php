
<div class="table-responsive">
  <table class="table table-striped b-t">
    <thead>
      <tr>
        {{-- <th style="width:20px;">
          <label class="ui-check m-a-0">
            <input type="checkbox"><i></i>
          </label>
        </th> --}}
        @foreach ($titulos as $titulo)
         <th>{{ $titulo }}</th>
        @endforeach
        <th></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($arr as $dato)
          <tr>
            {{-- <td><label class="ui-check m-a-0"><input type="checkbox" name="post[]"><i class="dark-white"></i></label></td> --}}
            @for($i=0; $i < count($columnas); $i++)
              @if($tipo[$i] == "imagen")
                <td><img src="{{asset($dato[$columnas[$i]])}}" imagen-modal="{{asset($dato[$columnas[$i]])}}" class="img-thumbnail previsualizar verImagenModal" width="100px"></td>
              @elseif($tipo[$i] == "multibotonessimple")
                <td><p class="m-b btn-groups objetivoarrbtnsTabla">
                  @forelse($dato[$columnas[$i]] as $botones)
                    <button class="btn btn-sm primary">{{$botones}}</button>
                  @empty
                  @endforelse
                </p></td>
              @elseif($tipo[$i] == "multibotones")
                <td><p class="m-b btn-groups objetivoarrbtnsTabla">
                  @forelse($dato[$columnas[$i]] as $botones)
                    <button class="btn btn-sm primary">{{$botones->nombre}}</button>
                  @empty
                  @endforelse
                </p></td>
              @elseif($tipo[$i] == "multimedia")
                <td><p class="m-b btn-groups objetivoarrbtnsTabla">
                  <button class="btn btn-sm success verArrFotos" base="{{ route('welcome') }}" arr='{{ $dato[$columnas[$i]] }}'>Ver más</button>
                </p></td>
              @elseif($tipo[$i] == "dinero")
                <td>{{ "$".number_format($dato[$columnas[$i]],2)." MXN" }}</td>
              @elseif($tipo[$i] == "delivery")
                <td>
                    @if($dato[$columnas[$i]] == "ENTREGADO")
                      <button tabla="{{$tabla}}" idItem="{{ $dato["id"] }}" class="btn btn-sm success activarEstado">Entregado</button>
                    @else
                      <button tabla="{{$tabla}}" idItem="{{ $dato["id"] }}" class="btn btn-sm danger activarEstado">Ninguno</button>
                    @endif
                </td>
              @elseif($tipo[$i] == "estado")
                <td>
                  <form class="form-horizontal" id="activarFormData" method="POST" action="{{route('ajaxs.activar')}}">
                    @csrf
                    <input type="hidden" name="iddato" value="{{ $dato["id"] }}">
                    <input type="hidden" name="tabla" value="{{$tabla}}">
                    <input type="hidden" class="estadoFata" name="estado" value="{{$dato[$columnas[$i]]}}">
                    @if($dato[$columnas[$i]] == "1")
                      <a tabla="{{$tabla}}"
                      @if(auth()->user()->role == "ADMIN")
                      idItem="{{ $dato["id"] }}" estado="{{$dato[$columnas[$i]]}}"
                      class="btn btn-sm success activarEstado"
                      @endif
                      >Activado</a>
                    @else
                      <a tabla="{{$tabla}}"
                      @if(auth()->user()->role == "ADMIN")
                      idItem="{{ $dato["id"] }}"
                      class="btn btn-sm warning activarEstado"
                      @endif
                      >Desactivado</a>
                    @endif
                  </form>
                </td>
              @else
                <td>{{ $dato[$columnas[$i]] }}</td>
              @endif
            @endfor
            <td>
              @if (detectarPrivacidad("eliminar",$area,$config,auth()->user()->role) || detectarPrivacidad("editar",$area,$config,auth()->user()->role))
                  <div class="dropdown pull-right">
                      <a class="text-muted" data-toggle="dropdown">
                        <button class="btn btn-sm info">Acciones</button>
                      </a>
                      <div class="dropdown-menu text-color" role="menu">
                          @if (detectarPrivacidad("editar",$area,$config,auth()->user()->role) || detectarPrivacidad("editar",$area,$config,auth()->user()->role))
                              <a class="dropdown-item editar" arr="{{$editar}}" tabla="{{$tabla}}" idItem="{{ $dato["id"] }}">
                                <i class="fa fa-pencil"></i>Editar
                              </a>
                          @endif
                          @if (detectarPrivacidad("crear",$area,$config,auth()->user()->role))
                              <a class="dropdown-item eliminar" tabla="{{$tabla}}" idItem="{{ $dato["id"] }}">
                                <i class="fa fa-trash"></i>Eliminar
                              </a>
                          @endif
                      </div>
                  </div>
                @endif
            </td>
          </tr>
        @endforeach

    </tbody>
  </table>
</div>