<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Scope;
use App;
use DB;

class EnviarDatosController extends Controller
{
    public function recibirDatos(Request $request){

            $usuarioNuevo = new App\Usuario;

            $usuarioRepetido = $usuarioNuevo::select('rutUsuario','emailUsuario')
                ->where('rutUsuario', '=', $request->rut)
                ->orWhere('emailUsuario', '=', $request->correo)
                ->get();

            if( count($usuarioRepetido) >0 ){
                return back()->with('mensajeError', 'El Correo y/o Rut ya se encuentran ingresados');
            }else{
                $usuarioNuevo->nombreUsuario = $request->nombre;
                $usuarioNuevo->apellidoUsuario = $request->apellido;
                $usuarioNuevo->emailUsuario = $request->correo;
                $usuarioNuevo->passUsuario = $request->pass;
                $usuarioNuevo->rutUsuario = $request->rut;

                $usuarioNuevo->save();

                return back()->with('mensajeSuccess', 'Registro Exitoso');
            }


            
    }

    public function iniciarUsuario(Request $request){

        $correo = $request->correo;
        $pass = $request->pass;

        $consultarUsuario = new App\Usuario;

        $usuario = $consultarUsuario::select('idUsuario','nombreUsuario','rutUsuario','emailUsuario','passUsuario')
                ->where('emailUsuario', '=', $correo)
                ->where('passUsuario', '=', $pass)
                ->get();

            foreach($usuario as $itemUsuario){
                $idUsuario=$itemUsuario->idUsuario;
                $nombreUsuario=$itemUsuario->nombreUsuario;
                $rutUsuario=$itemUsuario->rutUsuario;
            }


            if(count($usuario) > 0){
                session(['usuarioIdActivo' => $idUsuario]);
                session(['usuarioNombreActivo' => $nombreUsuario]);
                session(['usuarioRutActivo' => $rutUsuario]);

            
                return redirect()->route('crud');
            }else{
                return redirect()->route('login')->with('mensajeError', 'El Correo y la Contraseña no coinciden');
            }

    }

    public function rellenarComboBox(){
        $colores = App\Color::all();
        $tallas = App\Talla::all();

        return view('crudPolera', compact('colores', 'tallas'));
    }

    public static function rellenarComboBoxColor(){
        $colores = App\Color::all();

        return $colores;
    }

    public static function rellenarComboBoxTalla(){
        $tallas = App\Talla::all();

        return $tallas;
    }

    public function agregarPolera(Request $request){

        $usuarioIdActivo = session('usuarioIdActivo');

        $agregarPolera = new App\Polera;

        $skuRepetido = $agregarPolera::select('skuPolera')
        ->where('skuPolera', '=', $request->sku)
        ->get();

        if(count($skuRepetido)>0){
            return back()->with('mensajeError', 'El SKU ya existe');
        }else{
            $agregarPolera->skuPolera = $request->sku;
            $agregarPolera->marcaPolera = $request->marca;
            $agregarPolera->colorPolera = $request->cbxColor;
            $agregarPolera->tallapolera = $request->cbxTalla;
            $agregarPolera->precioPolera = $request->precio;
            $agregarPolera->stockPolera = $request->stock;
            $agregarPolera->precioPolera = $request->precio;
            $agregarPolera->stockPolera = $request->stock;
            $agregarPolera->usuarioInfoPolera = $usuarioIdActivo;

            date_default_timezone_set('Chile/Continental');

            $agregarPolera->fechaLastUpdPolera = date('d-m-Y');
            $agregarPolera->horaLastUpdPolera = date('H:i:s');

            $agregarPolera->save();

            return back()->with('mensajeSuccess', 'Polera agregada exitosamente');
        }

    }

    public function cerrarSesion(){
        session()->forget('usuarioNombreActivo');
        session()->forget('usuarioRutActivo');
        return redirect()->route('home');
    }

    public static function comprobarSesion(){
        if(session('usuarioNombreActivo')==null){
            return view('inicio');
        }else{
            return null;
        }
    }

    public static function rellenarTabla(){

        $poleras=DB::table('poleras')
        ->join('colors', 'colors.idColor', '=', 'poleras.colorPolera')
        ->join('tallas', 'tallas.idTalla', '=', 'poleras.tallaPolera')
        ->join('usuarios', 'usuarios.idUsuario', '=', 'poleras.usuarioInfoPolera')
        ->select('poleras.skuPolera','poleras.marcaPolera','colors.descripcion as colorPoleraAs',
        'tallas.descripcion as tallaPoleraAs','poleras.precioPolera','poleras.stockPolera',
        'usuarios.nombreUsuario as nombreUsuarioPolera','usuarios.rutUsuario as rutUsuarioPolera','poleras.fechaLastUpdPolera',
        'poleras.horaLastUpdPolera')
        ->get();


        return $poleras;
    }

    public static function mostrarDatosPolera($valor){

        $poleras=DB::table('poleras')
        ->join('colors', 'colors.idColor', '=', 'poleras.colorPolera')
        ->join('tallas', 'tallas.idTalla', '=', 'poleras.tallaPolera')
        ->join('usuarios', 'usuarios.idUsuario', '=', 'poleras.usuarioInfoPolera')
        ->select('poleras.skuPolera','poleras.marcaPolera','colors.descripcion as colorPoleraAs',
        'tallas.descripcion as tallaPoleraAs','poleras.precioPolera','poleras.stockPolera',
        'poleras.colorPolera','colors.idColor as idColorAs','poleras.tallaPolera', 'tallas.idTalla as idTallaAs',
        'usuarios.nombreUsuario as nombreUsuarioPolera','usuarios.rutUsuario as rutUsuarioPolera','poleras.fechaLastUpdPolera',
        'poleras.horaLastUpdPolera')
        ->where('skuPolera','=',$valor)
        ->get();

        return $poleras;
    }

    public function obtenerIdParaModificar(Request $request){
        $idPoleraModificar = $request->skuPoleraUpd;
        return view('/modificarPolera', compact('idPoleraModificar'));
    }

    public function obtenerIdParaEliminar(Request $request){
        $idPoleraEliminar = $request->skuPoleraDel;
        return view('/eliminarPolera', compact('idPoleraEliminar'));
    }

    public function modificarPolera(Request $request, $id){

        $usuarioIdActivo = session('usuarioIdActivo');

        $actualizarPolera = App\Polera::findOrFail($id);

        $actualizarPolera->skuPolera = $request->sku;
        $actualizarPolera->marcaPolera = $request->marca;
        $actualizarPolera->colorPolera = $request->cbxColor;
        $actualizarPolera->tallapolera = $request->cbxTalla;
        $actualizarPolera->precioPolera = $request->precio;
        $actualizarPolera->stockPolera = $request->stock;
        $actualizarPolera->precioPolera = $request->precio;
        $actualizarPolera->stockPolera = $request->stock;
        $actualizarPolera->usuarioInfoPolera = $usuarioIdActivo;

        date_default_timezone_set('Chile/Continental');

        $actualizarPolera->fechaLastUpdPolera = date('d-m-Y');
        $actualizarPolera->horaLastUpdPolera = date('H:i:s');


        $actualizarPolera->save();

        return redirect()->route('crud')->with('mensajeSuccess', 'Polera actualizada exitosamente');
    }

    public function eliminarPolera($id){

        $poleraEliminar = App\Polera::findOrFail($id);
        $poleraEliminar->delete();
        return redirect()->route('crud')->with('mensajeSuccess', 'Polera eliminada exitosamente');
    }

}