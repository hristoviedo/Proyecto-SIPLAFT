<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Inicio de la función home_administrador
    public function adm_user(){
        return view('adm_user'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_administrador
    public function adm_role(){
        return view('adm_role'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_administrador
    public function adm_company(){
        return view('adm_company'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_administrador
    public function adm_funding(){
        return view('adm_funding'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_administrador
    public function adm_risk(){
        return view('adm_risk'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_administrador
    public function adm_activity(){
        return view('adm_activity'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_administrador
    public function adm_log(){
        return view('adm_log'); //Muestra la vista de 'home_adm.blade.php'
    }
    //Fin de la función

}
