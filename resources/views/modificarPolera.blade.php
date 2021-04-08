@extends('plantillaPrincipal')


@section('titulo', 'Modificar Polera')

@section('contenido')

@if(session('usuarioNombreActivo'))

@else
    @include("inicio");
@endif

<div class="row">
    <div class="col-lg-12 centrado-logo">
        <h1 class="titulo-iniciarSesion">Bienvenido {{ $valor_almacenado = session('usuarioNombreActivo') }}</h1>
        <a href="{{ route('logout') }}" class="btn btn-secondary active" role="button" aria-pressed="true">Cerrar Sesión</a><br><br>
            <h1 class="titulo-iniciarSesion">MODIFICAR POLERA</h1>
            @foreach( App\Http\Controllers\EnviarDatosController::mostrarDatosPolera($idPoleraModificar) as $itemPolera )
                <form class="contenedor-iniciarSesion" method="post" action="{{ route('updateShirt', $itemPolera->skuPolera) }}">
                    @csrf
                    @method('PATCH')
                    @if(session('mensajeSuccess'))
                        <div class="alert alert-success">
                            {{ session('mensajeSuccess') }}
                        </div>
                    @endif
                        <div class="row">
                            <div class="col">
                                <label>SKU</label>
                                <input type="text" class="form-control" name="sku" value="{{ $itemPolera->skuPolera }}" id="sku" placeholder="Ingresar SKU..." minlength="8" maxlength="8" required readonly>
                            </div>

                            <div class="col">
                                <label>MARCA</label>
                                <input type="text" class="form-control" value="{{ $itemPolera->marcaPolera }}" name="marca" id="marca" placeholder="Ingresar Marca..." minlength="1" maxlength="30"  required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>COLOR</label><br>
                                <select class="form-control" name="cbxColor">
                                    
                                    <option value="{{ $itemPolera->idColorAs }}" selected>{{ $itemPolera->colorPoleraAs }}</option>
                                    
                                    @foreach( App\Http\Controllers\EnviarDatosController::rellenarComboBoxColor() as $itemColores )
                                        <option value="{{ $itemColores->idColor }}">{{ $itemColores->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label>TALLA</label>
                                <select class="form-control" name="cbxTalla">
                                    <option value="{{ $itemPolera->idTallaAs }}" selected>{{ $itemPolera->tallaPoleraAs }}</option>
                                    @foreach( App\Http\Controllers\EnviarDatosController::rellenarComboBoxTalla() as $itemTallas )
                                        <option value="{{ $itemTallas->idTalla }}">{{ $itemTallas->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>PRECIO</label>
                                <input type="number" class="form-control" value="{{ $itemPolera->precioPolera }}" name="precio" id="precio" min="1" max="9999999999" placeholder="Ingresar Precio..." required>
                            </div>

                            <div class="col">
                                <label>STOCK</label>
                                <input type="number" class="form-control" value="{{ $itemPolera->stockPolera }}" name="stock" id="stock" min="0" max="9999999999" placeholder="Ingresar Stock..." required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg  btn-posicion-iniciarSesion">Modificar Polera</button>
                        <a href="{{ route('crud') }}" class="btn btn-secondary btn-lg active btn-posicion-iniciarSesion" role="button" aria-pressed="true">Volver</a>
                </form>
            @endforeach
    </div>
</div>
@endsection()