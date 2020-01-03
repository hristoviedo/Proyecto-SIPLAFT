<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; // Permite trabajar con archivos de Excel
use DB; // Permite ejecutar consultas o llamar a procedimientos muy fácil

use App\Imports\ClientImport; // Permite realizar exportaciones según los datos seleccionados del cliente (No implementados)
use App\Exports\ClientExport; // Permite realizar exportaciones según los datos seleccionados del cliente (No implementados)
use App\Imports\TransactionImport; // Permite realizar exportaciones según los datos seleccionados de la transacción (No implementados)
use App\Exports\TransactionExport; // Permite realizar exportaciones según los datos seleccionados de la transacción (No implementados)



//Inicio del controlador
class HomeController extends Controller
{
    /**
     * Crea una nueva instancia del controlador
     *
     * @return void
     */

    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('auth'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
    }
    //Fin del constructor

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //Inicio de la función welcome
    public function welcome(){
        if( Auth::user() ) //se valida si esta logueado
            if( Auth::user()->role_id =='1' )       //se valida el tipo de usuario colaborador
                return redirect('col.client');
            elseif( Auth::user()->role_id =='2' )   //se valida el tipo de usuario supervisor
                return redirect('sup.client');
            elseif( Auth::user()->role_id =='3' )   //se valida el tipo de usuario administrador
                return redirect('adm.record');
            else
            return redirect('/login');              //se retorna al inicio de sesion
        else
            return redirect('/login');              //se retorna al inicio de sesion
    }//Fin de la función
} //Fin del controlador
