<?php

namespace App\Http\Controllers;

use App\Company; // Accede al modelo Company
use App\Role; // Accede al modelo Company
use App\User; // Accede al modelo User
use Illuminate\Http\Request;
use DB; // Permite ejecutar consultas o llamar a procedimientos muy fácil


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('adm'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
    }//Fin del constructor

    // Inicio de la función indexCompaniesAll
    public function indexCompaniesAll()
    {
        // Selecciona todas las compañías de la tabla
        $companies = Company::select('id', 'name')->get();

        return $companies; // Retorna la lista de compañias
    }

    // Inicio de la función indexRolesAll
    public function indexRolesAll()
    {
        // Selecciona todas las compañías de la tabla
        $roles = Role::select('id', 'name')->get();

        return $roles; // Retorna la lista de roles
    }// Fin de la función

    // Inicio de la función indexUsersAll
    public function indexUsersAll()
    {
        // Selecciona todas las transacciones de la tabla
        $sql = 'SELECT us.id AS user_id, us.name AS user_name, us.email AS user_email, us.active AS user_active,
        us.role_id AS user_role_id, us.company_id AS user_company_id, co.name AS user_company, ro.name AS user_role
        FROM users us, roles ro, companies co
        WHERE us.role_id = ro.id AND us.company_id = co.id
        ORDER BY user_id DESC';
        $users = DB::select($sql);

        return $users; //Retorna la lista de los usuarios registrados
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|integer|confirmed',
            'company_id' => 'required|integer|confirmed',
            'active' => 'required|boolean|confirmed',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password|string|min:8|confirmed',
        ]);
        User::update([
            'name' => trim(mb_strtoupper($request['name'])),
            'email' => $request['email'],
            'role_id' => $request['role_id'],
            'company_id' => $request['company_id'],
            'active' => $request['active'],
            'password' => Hash::make($request['password']),
        ]);
        return back()->with('message', 'Usuario Actualizado'); //Retorna a la página anterior cuando registra al usuario
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    //Inicio de la función destroy
    public function destroy($id)
    {
        $user = User::find($id); //Busca el usuario que tenga el id del parametro
        $user->delete(); //Elimina el registro
    }//Fin de la función
}//Fin de la clase
