@extends('plantillaPrincipal')


@section('titulo', 'Bodega CRUD')

@section('contenido')

@if(session('usuarioNombreActivo'))

@else
    @include("inicio");
@endif

<div class="row">
    <div class="col-lg-12 centrado-logo">
        <h1 class="titulo-iniciarSesion">Bienvenido {{ $valor_almacenado = session('usuarioNombreActivo') }}</h1>
        <a href="{{ route('logout') }}" class="btn btn-secondary active" role="button" aria-pressed="true">Cerrar Sesión</a><br><br>
            <h1 class="titulo-iniciarSesion">AGREGAR POLERA</h1>
            <form class="contenedor-iniciarSesion" method="POST" action="{{ route ('insertShirt') }}">
                @csrf
                @if(session('mensajeSuccess'))
                    <div class="alert alert-success">
                        {{ session('mensajeSuccess') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="sku" id="sku" placeholder="Ingresar SKU..." minlength="8" maxlength="8" required>
                    </div>

                    <div class="col">
                        <label>MARCA</label>
                        <input type="text" class="form-control" name="marca" id="marca" placeholder="Ingresar Marca..." minlength="1" maxlength="30"  required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>COLOR</label><br>
                        <select class="form-control" name="cbxColor">
                            @foreach($colores as $itemColores)
                            <option value="{{ $itemColores->idColor }}">{{ $itemColores->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label>TALLA</label>
                        <select class="form-control" name="cbxTalla">
                            @foreach($tallas as $itemTallas)
                            <option value="{{ $itemTallas->idTalla }}">{{ $itemTallas->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>PRECIO</label>
                        <input type="number" class="form-control" name="precio" id="precio" min="1" max="9999999999" placeholder="Ingresar Precio..." required>
                    </div>

                    <div class="col">
                        <label>STOCK</label>
                        <input type="number" class="form-control" name="stock" id="stock" min="0" max="9999999999" placeholder="Ingresar Stock..." required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg  btn-posicion-iniciarSesion">Agregar Polera</button>
            </form>
    </div>
</div>



<div class="table-responsive tabla-posicion">
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">SKU</th>
            <th scope="col">MARCA</th>
            <th scope="col">COLOR</th>
            <th scope="col">TALLA</th>
            <th scope="col">PRECIO</th>
            <th scope="col">STOCK</th>
            <th scope="col">NOMBRE TRABAJADOR</th>
            <th scope="col">RUT TRABAJADOR</th>
            <th scope="col">FECHA</th>
            <th scope="col">HORA</th>
            <th scope="col">MODIFICAR</th>
            <th scope="col">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            @forelse(\App\Http\Controllers\EnviarDatosController::rellenarTabla() as $itemPolera)
                <tr>
                <th>{{ $itemPolera->skuPolera }}</th>
                <td>{{ $itemPolera->marcaPolera }}</td>
                <td>{{ $itemPolera->colorPoleraAs }}</td>
                <td>{{ $itemPolera->tallaPoleraAs }}</td>
                <td>{{ $itemPolera->precioPolera }}</td>
                <td>{{ $itemPolera->stockPolera }}</td>
                <td>{{ $itemPolera->nombreUsuarioPolera }}</td>
                <td>{{ $itemPolera->rutUsuarioPolera }}</td>
                <td>{{ $itemPolera->fechaLastUpdPolera }}</td>
                <td>{{ $itemPolera->horaLastUpdPolera }}</td>
                <td class="btn-centrado-modificar_eliminar">
                    <form action="{{ route('getIdUpdate') }}" method="post">
                         @csrf
                        <input type="hidden" name="skuPoleraUpd" value="{{ $itemPolera->skuPolera }}" />
                        <button type="submit" value="" class="btn btn-outline-success" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 15 15">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                            </svg>
                        </button>
                    </form>
                </td>
                <td class="btn-centrado-modificar_eliminar">
                    <form action="{{ route('getIdDelete') }}" method="post">
                        @csrf
                        <input type="hidden" name="skuPoleraDel" value="{{ $itemPolera->skuPolera }}" />
                        <button type="submit" value="" class="btn btn-outline-danger" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </button>
                    </form>
                </td>
                </tr>

            @empty
                <h1 class=alerta-sinPoleras>NO HAY POLERAS</h1>
            @endforelse

        </tbody>
    </table>
</div>
@endsection()
