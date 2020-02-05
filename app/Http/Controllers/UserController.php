<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\EventsSIPLAFT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User; // Accede al modelo User
use App\Role; // Accede al modelo Company
use Illuminate\Support\Facades\Validator;
use App\Company; // Accede al modelo Company
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
        $this->middleware('active'); //Verifica que la solicitud proviene de un usuario activo.
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
    protected function register(Request $request)
    {
        $user_modifier_id = Auth::user()->id;
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_register = null;
        $record_new_data = null;
        $record_old_data = null;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role_id' => 'required|integer',
            'company_id' => 'required|integer',
            'active' => 'required|boolean',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password|string|min:8',
        ]);

        if ($validator->fails()) {
            $record_action = 'FALLÓ REGISTRO DE USUARIO';
            $record_modified_table = null;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            // dd($data);
            event( new EventsSIPLAFT( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);

            return redirect('adm.create.user')->withInput()->withErrors($validator);
        }else{
            User::create([
                'name' => trim(mb_strtoupper($request['name'])),
                'email' => $request['email'],
                'role_id' => $request['role_id'],
                'company_id' => $request['company_id'],
                'active' => $request['active'],
                'password' => Hash::make($request['password']),
                ]);
                $record_modified_table = 'USERS';
                $record_action = 'USUARIO REGISTRADO';
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                // dd($data);
                event( new EventsSIPLAFT( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
                return back()->with('message', 'Usuario registrado'); //Retorna a la página anterior cuando registra al usuario
        };

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
    public function update($id)
    {
        $user_modifier_id = Auth::user()->id;
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_table = 'USERS';

        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role_id' => 'required|integer',
            'company_id' => 'required|integer',
            'active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            $record_new_data = null;
            $record_old_data = null;
            $record_action = 'FALLÓ ACTUALIZACIÓN DE USUARIO';
            $record_modified_register = null;
            $record_modified_field = null;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSIPLAFT( $data ));
            return redirect('adm.show.user/' . $id)->withInput()->withErrors($validator);
        }else{
            $userUpdate = User::find($id);
            $record_action = 'USUARIO ACTUALIZADO';
            $record_modified_register = request()->email;
            // dd($userUpdate->name);
            if (request()->name != $userUpdate->name ){
                $record_modified_field = 'name';
                $record_new_data = request()->name;
                $record_old_data = $userUpdate->name;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSIPLAFT( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->email != $userUpdate->email ){
                $record_modified_field = 'email';
                $record_new_data = request()->email;
                $record_old_data = $userUpdate->email;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSIPLAFT( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->role_id != $userUpdate->role_id ){
                $record_modified_field = 'role_id';
                $record_new_data = request()->role_id;
                $record_old_data = $userUpdate->role_id;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSIPLAFT( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->company_id != $userUpdate->company_id ){
                $record_modified_field = 'company_id';
                $record_new_data = request()->company_id;
                $record_old_data = $userUpdate->company_id;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSIPLAFT( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->active != $userUpdate->active ){
                $record_modified_field = 'active';
                $record_new_data = request()->active;
                $record_old_data = $userUpdate->active;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSIPLAFT( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            $userUpdate->fill(request()->all());
            $userUpdate->save();
            return back()->with('message', 'Usuario Actualizado'); //Retorna a la página anterior cuando registra al usuario
        };

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
        $userDelete = User::find($id);
        $user_modifier_id = Auth::user()->id;
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_table = 'USERS';
        $record_action = 'USUARIO ELIMINADO';
        $record_modified_register = $userDelete->email;
        $record_modified_field = null;
        $record_new_data = null;
        $record_old_data = null;
        $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
        event( new EventsSIPLAFT( $data ));
        $findLastRecord = DB::table('records')->latest('id')->first();
        $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        $userDelete->delete(); //Elimina el registro
    }//Fin de la función
}//Fin de la clase
