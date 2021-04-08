@extends('plantillaPrincipal')

    @section('titulo', 'Home')

    @section('contenido')
    <div class="row">
      <div class="col-lg-6 centrado-logo">
        <img src="{{ asset('image/logo.png') }}" class="conf-logo">
      </div>
      <div class="contenedor-botones col-lg-6">
        <div class="row">
            <div class="col-lg-12 btn-centrado-iniciarSesion">
              <h1 class="titulo-home">
                BIENVENIDO
              </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 btn-centrado-iniciarSesion">
              <a href="{{ route('login') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Iniciar Sesión</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 btn-centrado-iniciarSesion">
              <a href="{{ route('register')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Registrarse</a>
            </div>
        </div>
      </div>
    </div>
    @endsection()
