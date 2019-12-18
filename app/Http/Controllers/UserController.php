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


    // Inicio de la función indexCompany
    public function indexCompaniesAll()
    {
        // Selecciona todas las compañías de la tabla
        $companies = Company::select('id', 'name')->get();

        return $companies;
    }

    public function indexRolesAll()
    {
        // Selecciona todas las compañías de la tabla
        $roles = Role::select('id', 'name')->get();

        return $roles;
    }

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

        return $users;
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

        $this->validate($request, [
            'role_id'       => 'required',
            'company_id'    => 'required',
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'active'        => 'required'
        ]);

        User::create($request->all());
        return;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
