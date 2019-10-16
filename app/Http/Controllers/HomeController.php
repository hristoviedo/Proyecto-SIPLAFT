<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use app\User;

use App\Exports\ClientExport;
use App\Imports\ClientImport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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
    public function index()
    {
        return view('home'); //Muestra la vista de 'home.blade.php'
    }

    public function welcome(){
        return view('welcome'); //Muestra la vista de 'welcome.blade.php'
    }

    public function descargar_clientes(){
        return view('home_col'); //Muestra la vista de 'home_col.blade.php'
    }

    public function exportExcel(){
        return Excel::download(new ClientExport, 'client-list.xlsx');
    }

    public function importExcel(Request $request){
        $file = $request->file('file');
        Excel::import(new ClientImport, $file);
        return back()->with('message', 'Importación de clientes completada');
    }
}
