<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Inicio de la clase TransactionExport
class AdminController extends Controller
{
    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('adm'); //Verifica que la solicitud proviene de un usuario registrado con el role de administrador.
        $this->middleware('active'); //Verifica que la solicitud proviene de un usuario activo.
    }
    //Fin del constructor

    //Inicio de la función adm_user
    public function adm_user(){
        return view('adm_user'); //Muestra la vista de 'adm_user.blade.php'
    }
    //Fin de la función

    //Inicio de la función adm_record
    public function adm_record(){
        return view('adm_record'); //Muestra la vista de 'adm_record.blade.php'
    }//Fin de la función

    //Inicio de la función adm_record
    public function user_update(){
        return view('user_update'); //Muestra la vista de 'adm_record.blade.php'
    }//Fin de la función
}//Fin de la clase
