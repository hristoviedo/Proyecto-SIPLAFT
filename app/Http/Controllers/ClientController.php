<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Activity;
use App\Funding;
use App\Risk;
use App\Transaction;
use DB; // Permite ejecutar consultas o llamar a procedimientos muy fácil

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $clients = Client::get();

        // return $clients;

        // Ordena los clientes de forma descendente y los agrupa de 10 en 10
        $clients = DB::table('clients')
        ->join('activities','clients.activity_id','=','activities.id')
        ->join('fundings','clients.funding_id','=','fundings.id')
        ->join('risks','clients.risk_id','=','risks.id')
        ->select('clients.id AS client_id', 'clients.identity AS client_identity', 'clients.name AS client_name', 'clients.age AS client_age', 'clients.email AS client_email',
                'clients.workplace AS client_workplace', 'clients.phone1 AS client_phone1', 'clients.phone2 AS client_phone2', 'clients.nationality AS client_nationality',
                'clients.households AS client_households', 'clients.total_amount AS client_total_amount', 'clients.score_risk AS client_score_risk',
                'activities.name AS client_activity','fundings.name AS client_funding', 'risks.name AS client_risk')
        ->paginate(10);
        // $clients = Client::select('id', 'activity_id','funding_id', 'risk_id', 'identity', 'name', 'age', 'email', 'workplace', 'phone1',
        //                         'phone2', 'nationality', 'households', 'total_amount', 'score_risk')
        //                     ->orderBy('id', 'DESC')
        //                     ->paginate(10);

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
    }

    public function index2()
    {
        // Selecciona todos los clientes de la tabla
        $sql = 'SELECT cl.id AS client_id, cl.identity AS client_identity, cl.name AS client_name, cl.email AS client_email, cl.age AS client_age, cl.workplace AS client_workplace,
                        cl.phone1 AS client_phone1, cl.phone2 AS client_phone2, cl.nationality AS client_nationality, cl.households AS client_households,
                        cl.total_amount AS client_total_amount, cl.score_risk AS client_score_risk, ac.name AS client_activity, fu.name AS client_funding,
                        ri.name AS client_risk
                FROM clients cl, activities ac, fundings fu, risks ri
                WHERE cl.activity_id = ac.id AND cl.funding_id = fu.id AND cl.risk_id = ri.id';
        $clients = DB::select($sql);

        return $clients; // Retorna la lista de clientes
    }

    public function indexClientXCompany()
    {
        // Selecciona todos los riesgos de la tabla
        $sql = 'SELECT DISTINCT cl.id AS client_id, co.name AS company_name FROM transactions tr, clients cl, companies co WHERE tr.client_id = cl.id AND tr.company_id = co.id ORDER BY cl.id';
        $clientxcompany = DB::select($sql);

        return $clientxcompany; // Retorna la lista de clientes por compañía
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
        //
    }
}
