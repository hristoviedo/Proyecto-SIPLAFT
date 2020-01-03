<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Inicio de la clase SupController
class SupController extends Controller
{
    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('sup'); //Verifica que la solicitud proviene de un usuario registrado con el role de supervisor.
    }
    //Fin del constructor

    //Inicio de la función sup_client
    public function sup_client(){
        return view('sup_client'); //Muestra la vista de 'sup_client.blade.php'
    }
    //Fin de la función

    //Inicio de la función sup_transaction
    public function sup_transaction(){
        return view('sup_transaction'); //Muestra la vista de 'sup_transaction.blade.php'
    }
    //Fin de la función
}//Fin de la clase
