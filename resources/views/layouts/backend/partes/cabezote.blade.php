<div class="app-header white bg b-b">
            <div class="navbar" data-pjax>
              <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                <i class="ion-navicon"></i>
              </a>
              {{-- <div class="navbar-item pull-left h5" id="pageTitle">
                {{Route::currentRouteName()}}
              </div> --}}
              <!-- nabar right -->
              <ul class="nav navbar-nav pull-right">
                  <li class="nav-item dropdown pos-stc-xs">
                      <a class="nav-link" data-toggle="dropdown">
                        <i class="ion-android-search w-24"></i>
                      </a>
                      <div class="dropdown-menu text-color w-md animated fadeInUp pull-right">
                          <!-- search form -->
                          <form class="navbar-form form-inline navbar-item m-a-0 p-x v-m" role="search">
                            <div class="form-group l-h m-a-0">
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search projects...">
                                <span class="input-group-btn">
                                  <button type="submit" class="btn white b-a no-shadow"><i class="fa fa-search"></i></button>
                                </span>
                              </div>
                            </div>
                          </form>
                          <!-- / search form -->
                      </div>
                  </li>
                  <li class="nav-item dropdown pos-stc-xs">
                      <a class="nav-link clear" data-toggle="dropdown">
                        <i class="ion-android-notifications-none w-24"></i>
                        <span class="label up p-a-0 danger"></span>
                      </a>
                      <!-- dropdown -->
                      <div class="dropdown-menu pull-right w-xl animated fadeIn no-bg no-border no-shadow">
                          <div class="scrollable" style="max-height: 220px">
                            <ul class="list-group list-group-gap m-a-0">
                              <li class="list-group-item dark-white box-shadow-z0 b">
                                <span class="pull-left m-r">
                                  <img src="images/a0.jpg" alt="..." class="w-40 img-circle">
                                </span>
                                <span class="clear block">
                                  Use awesome <a href="#" class="text-primary">animate.css</a><br>
                                  <small class="text-muted">10 minutes ago</small>
                                </span>
                              </li>
                              <li class="list-group-item dark-white box-shadow-z0 b">
                                <span class="pull-left m-r">
                                  <img src="images/a1.jpg" alt="..." class="w-40 img-circle">
                                </span>
                                <span class="clear block">
                                  <a href="#" class="text-primary">Joe</a> Added you as friend<br>
                                  <small class="text-muted">2 hours ago</small>
                                </span>
                              </li>
                              <li class="list-group-item dark-white text-color box-shadow-z0 b">
                                <span class="pull-left m-r">
                                  <img src="images/a2.jpg" alt="..." class="w-40 img-circle">
                                </span>
                                <span class="clear block">
                                  <a href="#" class="text-primary">Danie</a> sent you a message<br>
                                  <small class="text-muted">1 day ago</small>
                                </span>
                              </li>
                            </ul>
                          </div>
                      </div>
                      <!-- / dropdown -->
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link clear" data-toggle="dropdown">
                        <span class="avatar w-32">
                          <img src="{{ asset(auth()->user()->foto) }}" class="w-full rounded" alt="...">
                        </span>
                      </a>
                      <div class="dropdown-menu w dropdown-menu-scale pull-right">
                          <a class="dropdown-item info" style="color:white">
                              <span>{{auth()->user()->name}}</span>
                          </a>
                          @forelse ($stores2 as $store)
                            <a class="dropdown-item
                            @if($store->id == valorStore())
                              info" idSede="{{$store->id}}" style="color:white"
                            @else
                              cambiarStore" idSede="{{$store->id}}"
                            @endif
                            >
                                <span>Tienda {{$store->nombre}}</span>
                            </a>
                          @empty
                          @endforelse
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                          <form id="cambiar-tienda-form" action="{{ route('cambiarsede') }}" method="POST" style="display: none;">
                              @csrf
                              <input type="hidden" name="sede" class="sedeSelector" value="">
                          </form>
                      </div>
                  </li>
              </ul>
              <!-- / navbar right -->
            </div>
          </div>