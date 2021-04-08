@extends('plantillaPrincipal')


@section('titulo', 'Eliminar Polera')

@section('contenido')

@if(session('usuarioNombreActivo'))

@else
    @include("inicio");
@endif

<div class="row">
    <div class="col-lg-12 centrado-logo">
        <h1 class="titulo-iniciarSesion">Bienvenido {{ $valor_almacenado = session('usuarioNombreActivo') }}</h1>
        <a href="{{ route('logout') }}" class="btn btn-secondary active" role="button" aria-pressed="true">Cerrar Sesión</a><br><br>
            <h1 class="titulo-iniciarSesion">Eliminar POLERA</h1>
            @foreach( App\Http\Controllers\EnviarDatosController::mostrarDatosPolera($idPoleraEliminar) as $itemPolera )
                <form class="contenedor-iniciarSesion" method="post" action="{{ route('deleteShirt', $itemPolera->skuPolera) }}">
                    @csrf
                    @method('DELETE')
                        <div class="row">
                            <div class="col">
                                <label>SKU</label>
                                <input type="text" class="form-control" name="sku" value="{{ $itemPolera->skuPolera }}" id="sku" placeholder="Ingresar SKU..." minlength="8" maxlength="8" required readonly>
                            </div>

                            <div class="col">
                                <label>MARCA</label>
                                <input type="text" class="form-control" value="{{ $itemPolera->marcaPolera }}" name="marca" id="marca" placeholder="Ingresar Marca..." minlength="1" maxlength="30" required readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>COLOR</label><br>
                                <input type="text" class="form-control" value="{{ $itemPolera->colorPoleraAs }}" name="marca" id="marca" placeholder="Ingresar Marca..." minlength="1" maxlength="30" required readonly>
                            </div>

                            <div class="col">
                                <label>TALLA</label>
                                <input type="text" class="form-control" value="{{ $itemPolera->tallaPoleraAs }}" name="marca" id="marca" placeholder="Ingresar Marca..." minlength="1" maxlength="30" required readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>PRECIO</label>
                                <input type="number" class="form-control" value="{{ $itemPolera->precioPolera }}" name="precio" id="precio" min="1" max="9999999999" placeholder="Ingresar Precio..." required readonly>
                            </div>

                            <div class="col">
                                <label>STOCK</label>
                                <input type="number" class="form-control" value="{{ $itemPolera->stockPolera }}" name="stock" id="stock" min="0" max="9999999999" placeholder="Ingresar Stock..." required readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg  btn-posicion-iniciarSesion">Eliminar Polera</button>
                        <a href="{{ route('crud') }}" class="btn btn-secondary btn-lg active btn-posicion-iniciarSesion" role="button" aria-pressed="true">Volver</a>
                </form>
        @endforeach
    </div>
</div>
@endsection()