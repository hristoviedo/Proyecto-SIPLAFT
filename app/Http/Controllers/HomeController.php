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
        if( Auth::user() ) //se valida si esta logueado
            if( Auth::user()->role_id =='1' )        //se valida el tipo de usuario colaborador
                return redirect('col.client');
            elseif( Auth::user()->role_id =='2' )    //se valida el tipo de usuario supervisor
                return redirect('sup.client');
            else                                    //se valida el tipo de usuario adminnistrador
                return redirect('adm.record');
        else
            return redirect('/login');
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

    //Inicio de la función clientExportExcel
    public function clientExportExcel(){
        return Excel::download(new ClientExport, 'client-list.csv'); //Llama a la clase ClientExport para crear y descargar la lista de clientes en un excel.
    }
    //Fin de la función

    //Inicio de la función transactionExportExcel
    public function transactionExportExcel(){
        return Excel::download(new TransactionExport, 'UIFTR0120191219.csv'); //Llama a la clase TransactionExport para crear y descargar la lista de transacciones en un excel.
    }//Fin de la función

    //Inicio de la función clientImportExcel
    public function clientImportExcel(Request $request){ //Recibe como parámetro el archivo de excel
        $file = $request->file('file'); //Guarda en la variable $file el archivo excel
        Excel::import(new ClientImport, $file); //Llama a la clase ClientImport para subir la lista de clientes del excel.
        $matchTablesClients = DB::select('CALL matchTablesClients'); // Procedimiento Almacenado para relacionar clientes con otras tablas
        // $groupClients = DB::select('CALL groupClients'); // Procedimiento Almacenado para agrupar a los clientes con un mismo número de identidad
        $calculateRisks = DB::select('CALL calculateRisks'); // Procedimiento Almacenado para calcular el riesgo
        return back()->with('message', 'Lista de clientes enviada'); //Retorna a la página anterior cuando termina de importar
    }
    //Fin de la función

    //Inicio de la función transactionImportExcel
    public function TransactionImportExcel(Request $request){ //Recibe como parámetro el archivo de excel
        $company_id = auth()->user()->company_id;
        $user_id =  auth()->user()->id;
        $file = $request->file('file'); //Guarda en la variable $file el archivo excel
        Excel::import(new TransactionImport, $file); //Llama a la clase TransactionImport para subir la lista de transacciones del excel.
        $matchTablesTransactions = DB::select('CALL matchTablesTransactions (?, ?)', array($user_id,$company_id)); // Procedimiento Almacenado para relacionar clientes con otras tablas
        return back()->with('message', 'Lista de transacciones enviada'); //Retorna a la página anterior cuando termina de importar
    }
    //Fin de la función
} //Fin del controlador
