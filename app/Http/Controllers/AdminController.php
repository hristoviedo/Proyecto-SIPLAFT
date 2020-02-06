<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $records = DB::table('records')
                ->latest('record_date')
                ->get();
        $users = User::all();
        $roles = Role::all();
        return view('adm_record', compact('records','users','roles')); //Muestra la vista de 'adm_record.blade.php'
    }//Fin de la función

    //Inicio de la función adm_record
    public function adm_create_user(){
        $companies = Company::all();
        $roles = Role::all();
        return view('Auth/register', compact('companies','roles')); //Muestra la vista de 'adm_record.blade.php'
    }//Fin de la función

    //Inicio de la función adm_user
    public function adm_show_user($id){
        $user = DB::table('users')
                ->where('id', $id)
                ->get();
        // dd($user);
        $roles = Role::all();
        $companies = Company::all();
        return view('user_update', compact('user','companies','roles')); //Muestra la vista de 'user_update.blade.php'
    }
    //Fin de la función
}//Fin de la clase
