<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PageController extends Controller
{
    //public function inicio(){
    //    $colores = App\Color::all();

    //    return view('plantillaGeneral', compact('colores'));
   // }

    public function inicio(){
        return view('/inicio');
    }

    public function inicioSesion(){
        return view('/iniciarSesion');
    }

    public function registroUsuario(){
        return view('/registroUsuario');
    }



}
