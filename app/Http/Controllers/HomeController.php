<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use DB;

use App\Exports\ClientExport;
use App\Imports\ClientImport;

//Inicio del controlador
class HomeController extends Controller
{
    /**
     * Crea una nueva instancia del controlador
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //Inicio de la función index
    public function index()
    {
        return view('home'); //Muestra la vista de 'home.blade.php'
    }//Fin de la función

    //Inicio de la función welcome
    public function welcome(){
        return view('welcome'); //Muestra la vista de 'welcome.blade.php'
    }//Fin de la función

    //Inicio de la función home_colaborador
    public function home_colaborador(){
        return view('home_col'); //Muestra la vista de 'home_col.blade.php'
    }//Fin de la función

    //Inicio de la función home_supervisor
    public function home_supervisor(){
        return view('home_sup'); //Muestra la vista de 'home_sup.blade.php'
    }//Fin de la función

    //Inicio de la función home_supervisor
    public function home_supervisor2(){
        return view('home_sup2'); //Muestra la vista de 'home_sup.blade.php'
    }//Fin de la función

    public function simulation(){
        return view('simulation'); //Muestra la vista de 'simulation.blade.php'
    }//Fin de la función

    //Inicio de la función exportExcel
    public function exportExcel(){
        return Excel::download(new ClientExport, 'client-list.xlsx'); //Llama a la clase ClientExport para crear y descargar la lista de clientes en excel.
    }//Fin de la función

    //Inicio de la función importExcel
    public function importExcel(Request $request){ //Recibe como parámetro el archivo de excel
        $file = $request->file('file'); //Guarda en la variable $file el archivo excel
        Excel::import(new ClientImport, $file); //Llama a la clase ClientImport para subir y la lista de clientes de un excel.
        $order = DB::select('CALL agruparClientes');
        $risk = DB::select('CALL calcularRiesgo');
        return back()->with('message', 'Importación de clientes completada'); //Retorna a la página anterior cuando termina de importar
    }//Fin de la función
} //Fin del controlador
