<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupController extends Controller
{
    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('sup'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
        // $this->middleware('adm'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
    }
    //Fin del constructor

    //Inicio de la función home_supervisor
    public function sup_client(){
        return view('sup_client'); //Muestra la vista de 'home_sup.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_supervisor
    public function sup_transaction(){
        return view('sup_transaction'); //Muestra la vista de 'home_sup.blade.php'
    }
    //Fin de la función
}
