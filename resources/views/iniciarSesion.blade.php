@extends('plantillaPrincipal')

@section('titulo', 'Inicio Sesion')

@section('contenido')
<div class="row">
    <div class="col-lg-12 centrado-logo">
        <h1 class="titulo-iniciarSesion">Iniciar Sesión</h1>
        <form name="formIniciarSesion" class="contenedor-iniciarSesion" method="POST" action="{{route('loginUser')}}">
            @csrf
            @if(session('mensajeError'))
                <div class="alert alert-danger">
                    {{ session('mensajeError') }}
                </div>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Correo Electronico</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="correo" aria-describedby="emailHelp" placeholder="Ingresar Correo..." required><br>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pass" placeholder="Ingresar Contraseña..." required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg  btn-posicion-iniciarSesion">Iniciar Sesión</button>
            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg active btn-posicion-iniciarSesion" role="button" aria-pressed="true">Volver</a>
        </form>
    </div>
</div>
@endsection()