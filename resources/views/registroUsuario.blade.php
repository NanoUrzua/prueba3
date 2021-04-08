@extends('plantillaPrincipal')

@section('titulo', 'Registrar')
@section('contenido')
<div class="row">
    <div class="col-lg-12 centrado-logo">
        <form name="formRegistrarUsuario" class="contenedor-iniciarSesion" method="POST" action="{{ route ('insertUser') }}">
            @csrf
            <h1 class="titulo-iniciarSesion">Registrar Usuario</h1>
            @if(session('mensajeSuccess'))
                <div class="alert alert-success">
                    {{ session('mensajeSuccess') }}
                </div>
            @endif
            @if(session('mensajeError'))
                <div class="alert alert-danger">
                    {{ session('mensajeError') }}
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar Nombre..." required>
                </div>
                <div class="col">
                    <label>Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresar Primer Apellido..." required>
                </div>
            </div>
            <div class="form-group">
                <label>Rut</label>
                <input type="text" class="form-control" name="rut" id="rut" aria-describedby="emailHelp" placeholder="xxxxxxxx-x" required>
            </div>
            <div class="form-group">
                <label>Correo Electronico</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelp" placeholder="Ingresar Correo..." required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Ingresar Contraseña..." required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg  btn-posicion-iniciarSesion">Registrar Usuario</button>
            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg active btn-posicion-iniciarSesion" role="button" aria-pressed="true">Volver</a>
        </form>
    </div>
</div>
@endsection()