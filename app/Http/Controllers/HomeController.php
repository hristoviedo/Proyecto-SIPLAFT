<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    // Inicio de la función welcome
    public function __construct()
    {
        $this->middleware('auth'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
    }
    //Fin de la función

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //Inicio de la función index
    public function index()
    {
        return view('home'); //Muestra la vista de 'home.blade.php'
    }
    //Fin de la función

    //Inicio de la función welcome
    public function welcome(){
        return view('welcome'); //Muestra la vista de 'welcome.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_colaborador
    public function col_client(){
        return view('col_client'); //Muestra la vista de 'home_col.blade.php'
    }
    //Fin de la función

    //Inicio de la función home_colaborador
    public function col_transaction(){
        return view('col_transaction'); //Muestra la vista de 'home_col.blade.php'
    }
    //Fin de la función

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

    public function col_simulation(){
        return view('col_simulation'); //Muestra la vista de 'simulation.blade.php'
    }
    //Fin de la función

    //Inicio de la función exportClientExcel
    public function exportClientExcel(){
        return Excel::download(new ClientExport, 'client-list.xlsx'); //Llama a la clase ClientExport para crear y descargar la lista de clientes en un excel.
    }
    //Fin de la función

    //Inicio de la función exportTransactionExcel
    public function exportTransactionExcel(){
        return Excel::download(new TransactionExport, 'transaction-list.xlsx'); //Llama a la clase TransactionExport para crear y descargar la lista de transacciones en un excel.
    }//Fin de la función

    //Inicio de la función importClientExcel
    public function importClientExcel(Request $request){ //Recibe como parámetro el archivo de excel
        $file = $request->file('file'); //Guarda en la variable $file el archivo excel
        Excel::import(new ClientImport, $file); //Llama a la clase ClientImport para subir la lista de clientes del excel.
        $order = DB::select('CALL agruparClientes'); // Procedimiento Almacenado en desuso
        $risk = DB::select('CALL calcularRiesgo'); // Procedimiento Almacenado en desuso
        return back()->with('message', 'Subida de clientes completada'); //Retorna a la página anterior cuando termina de importar
    }
    //Fin de la función

    //Inicio de la función importTransactionExcel
    public function importTransactionExcel(Request $request){ //Recibe como parámetro el archivo de excel
        $file = $request->file('file'); //Guarda en la variable $file el archivo excel
        Excel::import(new TransactionImport, $file); //Llama a la clase TransactionImport para subir la lista de transacciones del excel.
        return back()->with('message', 'Subida de transacciones completada'); //Retorna a la página anterior cuando termina de importar
    }
    //Fin de la función

} //Fin del controlador
