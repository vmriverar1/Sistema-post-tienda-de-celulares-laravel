@extends('layouts.backend.plantilla')

@section('contenido1')

    <div class="padding">
    <div class="navbar">
      <div class="pull-center">
        <!-- brand -->
        <a href="index.html" class="navbar-brand">
            <div data-ui-include="'{{asset('tienda/logo.png')}}'"></div>
            <img src="{{asset('tienda/logo.png')}}" alt=".">
            {{-- <span class="hidden-folded inline">aside</span> --}}
        </a>
        <!-- / brand -->
      </div>
    </div>
  </div>
  <div class="b-t">
    <div class="center-block w-xxl w-auto-xs p-y-md text-center">
      <div class="p-a-md">
        {{-- <div>
          <a href="#" class="btn btn-block indigo text-white m-b-sm">
            <i class="fa fa-facebook pull-left"></i>
            Sign in with Facebook
          </a>
          <a href="#" class="btn btn-block red text-white">
            <i class="fa fa-google-plus pull-left"></i>
            Sign in with Google+
          </a>
        </div> --}}

        <form name="form" method="POST" action="{{ route('ingreso') }}">
            @csrf
            <div class="form-group">
                <input type="email"  name="email" class="form-control" placeholder="Email" value="{{old('email')}}"required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            {{-- <div class="m-b-md">
                <label class="md-check">
                    <input type="checkbox"><i class="primary"></i> Keep me signed in
                </label>
            </div> --}}
            <button type="submit" class="btn btn-lg black p-x-lg">Ingresar</button>
        </form>
        {{-- <div class="m-y">
          <a href="forgot-password.html" class="_600">Forgot password?</a>
        </div> --}}
        {{-- <div>
          Do not have an account?
          <a href="signup.html" class="text-primary _600">Sign up</a>
        </div> --}}
      </div>
    </div>
  </div>

@endsection
