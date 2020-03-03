<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\EventsSiplaft;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User; // Accede al modelo User
use App\Role; // Accede al modelo Company
use Illuminate\Support\Facades\Validator;
use App\Company; // Accede al modelo Company
use App\Client; // Accede al modelo Client
use DB; // Permite ejecutar consultas o llamar a procedimientos muy fácil

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Inicio del constructor
    public function __construct()
    {
        $this->middleware('auth'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
    }//Fin del constructor

    //Inicio de la funcion index
    public function index(Request $request)
    {

        // Ordena los clientes de forma descendente y los agrupa de 10 en 10
        $clients = DB::table('clients')
        ->join('activities','clients.activity_id','=','activities.id')
        ->join('fundings','clients.funding_id','=','fundings.id')
        ->join('risks','clients.risk_id','=','risks.id')
        ->select('clients.id AS client_id', 'clients.identity AS client_identity', 'clients.name AS client_name', 'clients.age AS client_age', 'clients.email AS client_email',
                'clients.workplace AS client_workplace', 'clients.workstation AS client_workstation','clients.salary AS client_salary', 'clients.phone1 AS client_phone1',
                'clients.phone2 AS client_phone2', 'clients.nationality AS client_nationality', 'clients.households AS client_households', 'clients.total_amount AS client_total_amount',
                'clients.score_risk AS client_score_risk', 'activities.name AS client_activity','fundings.name AS client_funding', 'risks.name AS client_risk')
        ->orderByDesc('client_score_risk')
        ->paginate(15);

        // Retorna la lista de clientes, el total y otros datos para la paginación
        return [
            'pagination' => [
                'total'        => $clients->total(),
                'current_page' => $clients->currentPage(),
                'per_page'     => $clients->perPage(),
                'last_page'    => $clients->lastPage(),
                'from'         => $clients->firstItem(),
                'to'           => $clients->lastItem(),
            ],
            'clients' => $clients,
        ];
    }//Fin de la funcion

    //Inicio de la función index2
    public function index2()
    {
        // Selecciona todos los clientes de la tabla
        $sql = 'SELECT cl.id AS client_id, cl.identity AS client_identity, cl.name AS client_name, cl.email AS client_email, cl.age AS client_age, cl.workplace AS client_workplace, cl.workstation AS client_workstation,
                        cl.salary AS client_salary, cl.phone1 AS client_phone1, cl.phone2 AS client_phone2, cl.nationality AS client_nationality, cl.households AS client_households, cl.total_amount AS client_total_amount,
                        cl.score_risk AS client_score_risk, ac.name AS client_activity, fu.name AS client_funding, ri.name AS client_risk
                FROM clients cl, activities ac, fundings fu, risks ri
                WHERE cl.activity_id = ac.id AND cl.funding_id = fu.id AND cl.risk_id = ri.id
                ORDER BY client_score_risk DESC';
        $clients = DB::select($sql);

        return $clients; // Retorna la lista de clientes
    }//Fin de la funcion

    //Inicio de la función indexClientXCompany
    public function indexClientXCompany()
    {
        // Selecciona todos los riesgos de la tabla
        $sql = 'SELECT DISTINCT cl.id AS client_id, co.name AS company_name FROM transactions tr, clients cl, companies co WHERE tr.client_id = cl.id AND tr.company_id = co.id ORDER BY cl.id';
        $clientxcompany = DB::select($sql);

        return $clientxcompany; // Retorna la lista de clientes por compañía
    }//Fin de la funcion

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $user_modifier_id = Auth::user()->id;
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_register = null;
        $record_new_data = null;
        $record_old_data = null;

        $validator = Validator::make($request->all(), [
            'identity'      => 'required|string|max:16|min:15|unique:clients',
            'name'          => 'required|string|max:40',
            'email'         => 'required|email|max:40',
            'age'           => 'required|integer|max:100|min:15',
            'phone1'        => 'string|max:15',
            'phone2'        => 'max:15',
            'nationality'   => 'max:20',
            'workplace'     => 'max:30',
            'workstation'   => 'max:45',
            'activity'      => 'required|integer',
            'funding'       => 'required|integer',
        ]);

        if ($validator->fails()) {
            $record_action = 'FALLÓ REGISTRO DE CLIENTE';
            $record_modified_table = null;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action,
            'record_date' => $record_date , 'record_modified_table' => $record_modified_table,
            'record_modified_register' => $record_modified_register, 'record_new_data' => $record_new_data,
            'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            return redirect('col.client.form')->withInput()->withErrors($validator);
        }else{
            Client::create([
                'identity'      => trim(mb_strtoupper($request['identity'])),
                'name'          => trim(mb_strtoupper($request['name'])),
                'email'         => trim(mb_strtolower($request['email'])),
                'age'           => $request['age'],
                'phone1'        => $request['phone1'],
                'phone2'        => $request['phone2'],
                'nationality'   => trim(mb_strtoupper($request['nationality'])),
                'workplace'     => trim(mb_strtoupper($request['workplace'])),
                'workstation'   => trim(mb_strtoupper($request['workstation'])),
                'salary'        => (float)$request['salary'],
                'activity_id'   => $request['activity'],
                'funding_id'    => $request['funding'],
                ]);
                $record_modified_table = 'CLIENTS';
                $record_action = 'REGISTRÓ NUEVO CLIENTE';
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
                $calculateRisksAll = DB::select('CALL calculateRisksAll');
                return back()->with('message', 'Cliente registrado'); //Retorna a la página anterior cuando registra al usuario
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
        //
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
    public function update(Request $request, $idClient)
    {
        $user_modifier_id = Auth::user()->id;
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_table = 'CLIENTS';
        $record_modified_register = null;
        $record_new_data = null;
        $record_old_data = null;

        $validator = Validator::make($request->all(), [
            'identity'      => 'required|string|max:16|min:15|unique:clients,identity,'.$idClient,
            'name'          => 'required|string|max:40',
            'email'         => 'required|email|max:40',
            'age'           => 'required|integer|max:100|min:15',
            'phone1'        => 'string|max:15',
            'phone2'        => 'max:15',
            'nationality'   => 'max:20',
            'workplace'     => 'max:30',
            'workstation'   => 'max:45',
            'activity_id'   => 'required|integer',
            'funding_id'    => 'required|integer',
        ]);

        if ($validator->fails()) {
            $record_action = 'FALLÓ ACTUALIZACIÓN DE CLIENTE';
            $record_modified_table = null;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action,
            'record_date' => $record_date , 'record_modified_table' => $record_modified_table,
            'record_modified_register' => $record_modified_register, 'record_new_data' => $record_new_data,
            'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            return back()->withInput()->withErrors($validator);
        }else{
            $clientUpdate = Client::find($idClient);
            $record_action = 'ACTUALIZÓ CLIENTE';
            $record_modified_register = request()->email;
            if (request()->identity != $clientUpdate->identity){
                $record_modified_field = 'identity';
                $record_new_data = request()->identity;
                $record_old_data = $clientUpdate->identity;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->name != $clientUpdate->name ){
                $record_modified_field = 'name';
                $record_new_data = request()->name;
                $record_old_data = $clientUpdate->name;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->email != $clientUpdate->email ){
                $record_modified_field = 'email';
                $record_new_data = request()->email;
                $record_old_data = $clientUpdate->email;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->age != $clientUpdate->age ){
                $record_modified_field = 'age';
                $record_new_data = request()->age;
                $record_old_data = $clientUpdate->age;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->phone1 != $clientUpdate->phone1 ){
                $record_modified_field = 'phone1';
                $record_new_data = request()->phone1;
                $record_old_data = $clientUpdate->phone1;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->phone2 != $clientUpdate->phone2 ){
                $record_modified_field = 'phone2';
                $record_new_data = request()->phone2;
                $record_old_data = $clientUpdate->phone2;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->nationality != $clientUpdate->nationality ){
                $record_modified_field = 'nationality';
                $record_new_data = request()->nationality;
                $record_old_data = $clientUpdate->nationality;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->workplace != $clientUpdate->workplace ){
                $record_modified_field = 'workplace';
                $record_new_data = request()->workplace;
                $record_old_data = $clientUpdate->workplace;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->workstation != $clientUpdate->workstation ){
                $record_modified_field = 'workstation';
                $record_new_data = request()->workstation;
                $record_old_data = $clientUpdate->workstation;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->salary != $clientUpdate->salary ){
                $record_modified_field = 'salary';
                $record_new_data = request()->salary;
                $record_old_data = $clientUpdate->salary;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->activity_id != $clientUpdate->activity_id ){
                $record_modified_field = 'activity_id';
                $record_new_data = request()->activity_id;
                $record_old_data = $clientUpdate->activity_id;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            if (request()->funding_id != $clientUpdate->funding_id ){
                $record_modified_field = 'funding_id';
                $record_new_data = request()->funding_id;
                $record_old_data = $clientUpdate->funding_id;
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            };
            $clientUpdate->fill(request()->all());
            $clientUpdate->save();
            $calculateRisksAll = DB::select('CALL calculateRisksAll');
            return back()->with('message', 'Cliente Actualizado'); //Retorna a la página anterior cuando registra al usuario
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
