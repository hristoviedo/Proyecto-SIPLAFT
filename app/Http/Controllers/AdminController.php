<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('adm'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
    }
    //Fin del constructor

    //Inicio de la función home_administrador
    public function adm_user(){
        return view('adm_user'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_administrador
    public function adm_record(){
        return view('adm_record'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

}
