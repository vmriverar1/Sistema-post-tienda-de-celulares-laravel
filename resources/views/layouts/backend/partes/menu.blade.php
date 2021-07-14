<div id="aside" class="app-aside fade nav-dropdown black folded">
  <div class="navside dk" data-layout="column">
    <div class="navbar no-radius">
      <!-- brand -->
      <a href="index.html" class="navbar-brand">
        <div data-ui-include="'images/logo.svg'"></div>
        <img src="images/logo.png" alt="." class="hide">
        <span class="hidden-folded inline">aside</span>
      </a>
      <!-- / brand -->
    </div>
    <div data-flex class="hide-scroll">
        <nav class="scroll nav-stacked nav-stacked-rounded nav-color">
          <ul class="nav" data-ui-nav>

            <li class="nav-header hidden-folded">
              <span class="text-xs">Main</span>
            </li>

            <li>
              <a href="{{route('welcome')}}" class="b-danger">
                <span class="nav-icon text-white no-fade">
                  <i class="ion-filing"></i>
                </span>
                <span class="nav-text">Inicio</span>
              </a>
            </li>

            @if(detectarPrivacidad("menu","compraprod",$config,auth()->user()->role))
                <li>
                  <a class="b-danger abrirGastoMenu">
                    <span class="nav-icon text-white no-fade">
                      <i class="fa fa-usd"></i>
                    </span>
                    <span class="nav-text">Gasto</span>
                  </a>
                </li>
            @endif

            {{-- ADMINISTRACION DE CATEGORIAS CIUDADES Y PRODUCTOS --}}
            @if(detectarPrivacidad("menu","categorias",$config,auth()->user()->role) || detectarPrivacidad("menu","subcategorias",$config,auth()->user()->role) || detectarPrivacidad("menu","marcas",$config,auth()->user()->role) || detectarPrivacidad("menu","cajas",$config,auth()->user()->role) || detectarPrivacidad("menu","marcas",$config,auth()->user()->role))
                <li>
                    <a class="b-info">
                        <span class="nav-caret">
                            <i class="fa fa-caret-down"></i>
                        </span>
                        <span class="nav-icon text-white no-fade">
                            <i class="fa fa-cube"></i>
                        </span>
                        <span class="nav-text">Administrar</span>
                    </a>
                  <ul class="nav-sub nav-mega nav-mega-1">
                        @if(detectarPrivacidad("menu","categorias",$config,auth()->user()->role))
                            <li>
                                <a href="{{route('categorias')}}" >
                                    <span class="nav-text" style="color: white">Categorias</span>
                                </a>
                            </li>
                        @endif
                        @if(detectarPrivacidad("menu","subcategorias",$config,auth()->user()->role))
                            <li>
                                <a href="{{route('subcategorias')}}" >
                                    <span class="nav-text" style="color: white">Subcategorias</span>
                                </a>
                            </li>
                        @endif
                        @if(detectarPrivacidad("menu","marcas",$config,auth()->user()->role))
                            <li>
                              <a href="{{route('marcas')}}" >
                                <span class="nav-text" style="color: white">Marcas</span>
                              </a>
                            </li>
                        @endif
                        @if(detectarPrivacidad("menu","cajas",$config,auth()->user()->role))
                            <li>
                              <a href="{{route('cajas')}}" >
                                <span class="nav-text" style="color: white">Cajas</span>
                              </a>
                            </li>
                        @endif
                  </ul>
                </li>
            @endif

            @if(detectarPrivacidad("menu","productos",$config,auth()->user()->role))
                <li>
                  <a href="{{route('productos')}}" class="b-info">
                    <span class="nav-icon text-white no-fade">
                      <i class="fa fa-gift"></i>
                    </span>
                    <span class="nav-text">Productos</span>
                  </a>
                </li>
            @endif

            @if($cajaact != "eliminar")
            <li>
              <a href="{{route('ventas')}}" class="b-success">
                <span class="nav-icon text-white no-fade">
                  <i class="fa fa-usd"></i>
                </span>
                <span class="nav-text">Ventas</span>
              </a>
            </li>
            @endif
            @if(detectarPrivacidad("menu","usuarios",$config,auth()->user()->role) || detectarPrivacidad("menu","clientes",$config,auth()->user()->role) || detectarPrivacidad("menu","proveedores",$config,auth()->user()->role) || detectarPrivacidad("menu","cajas",$config,auth()->user()->role) || detectarPrivacidad("menu","sedes",$config,auth()->user()->role))
                  <li>
                    <a class="b-info">
                        <span class="nav-caret">
                            <i class="fa fa-caret-down"></i>
                        </span>
                        <span class="nav-icon text-white no-fade">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-text">Usuarios</span>
                    </a>
                    <ul class="nav-sub nav-mega nav-mega-1">
                      @if(detectarPrivacidad("menu","usuarios",$config,auth()->user()->role))
                          <li>
                              <a href="{{route('usuarios')}}" >
                                  <span class="nav-text" style="color: white">Empleados</span>
                              </a>
                          </li>
                      @endif
                      @if(detectarPrivacidad("menu","clientes",$config,auth()->user()->role))
                          <li>
                              <a href="{{route('clientes')}}" >
                                  <span class="nav-text" style="color: white">Clientes</span>
                              </a>
                          </li>
                      @endif
                      @if(detectarPrivacidad("menu","proveedores",$config,auth()->user()->role))
                          <li>
                            <a href="{{route('proveedor')}}" >
                              <span class="nav-text" style="color: white">Proveedores</span>
                            </a>
                          </li>
                      @endif
                      @if(detectarPrivacidad("menu","sedes",$config,auth()->user()->role))
                          <li>
                            <a href="{{route('sede')}}" >
                              <span class="nav-text" style="color: white">Sedes</span>
                            </a>
                          </li>
                      @endif
                    </ul>
                  </li>
            @endif


            @if(detectarPrivacidad("menu","rgenerales",$config,auth()->user()->role) || detectarPrivacidad("menu","rventas",$config,auth()->user()->role) || detectarPrivacidad("menu","rcajas",$config,auth()->user()->role))

                  <li>
                      <a class="">
                          <span class="nav-caret">
                              <i class="fa fa-caret-down"></i>
                          </span>
                          <span class="nav-icon text-white no-fade">
                              <i class="ion-pie-graph"></i>
                          </span>
                          <span class="nav-text">Reportes</span>
                      </a>
                    <ul class="nav-sub nav-mega nav-mega-1">
                      @if(detectarPrivacidad("menu","rgenerales",$config,auth()->user()->role))
                        <li>
                            <a href="{{route('reporte-general')}}" >
                                <span class="nav-text" style="color: white">Generales</span>
                            </a>
                        </li>
                      @endif
                      @if(detectarPrivacidad("menu","rventas",$config,auth()->user()->role))
                        <li>
                            <a href="{{route('reporte-cajas')}}" >
                                <span class="nav-text" style="color: white">Caja chica</span>
                            </a>
                        </li>
                      @endif
                      @if(detectarPrivacidad("menu","rcajas",$config,auth()->user()->role))
                        <li>
                          <a href="{{route('reporte-ventas')}}" >
                            <span class="nav-text" style="color: white">Ventas</span>
                          </a>
                        </li>
                      @endif
                    </ul>
                  </li>
            @endif


            @if(auth()->user()->role == "ADMIN")
                <li>
                  <a href="{{route('configuraciones')}}" class="b-warning">
                    <span class="nav-icon text-white no-fade">
                      <i class="fa fa-gear" style="color:white;"></i>
                    </span>
                    <span class="nav-text">Configuraciones</span>
                  </a>
                </li>
            @endif


          </ul>
        </nav>
    </div>
    <div data-flex-no-shrink>
      <div class="nav-fold dropup">
        <a data-toggle="dropdown">
            <div class="pull-left">
              <div class="inline"><span class="avatar w-40 grey">JR</span></div>
              <img src="images/a0.jpg" alt="..." class="w-40 img-circle hide">
            </div>
            <div class="clear hidden-folded p-x">
              <span class="block _500 text-muted">Jean Reyes</span>
              <div class="progress-xxs m-y-sm lt progress">
                  <div class="progress-bar info" style="width: 15%;">
                  </div>
              </div>
            </div>
        </a>
        <div class="dropdown-menu w dropdown-menu-scale ">
          <a class="dropdown-item" href="profile.html">
            <span>Perfil</span>
          </a>
          {{-- {{ crearAreasBtn($empresa) }} --}}
          {{-- <a class="dropdown-item" href="setting.html">
            <span>Settings</span>
          </a> --}}
          {{-- <a class="dropdown-item" href="app.inbox.html">
            <span>Inbox</span>
          </a> --}}
          {{-- <a class="dropdown-item" href="app.message.html">
            <span>Message</span>
          </a> --}}

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="docs.html">
            Need help?
          </a>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
