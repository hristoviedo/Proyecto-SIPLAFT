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
        $clients = Client::select('id', 'activity_id','funding_id', 'risk_id', 'identity', 'name', 'age', 'email', 'workplace', 'phone1',
                                'phone2', 'nationality', 'households', 'total_amount', 'score_risk')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);

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
        $sql = 'SELECT cl.id AS id_client, cl.identity AS identity_client, cl.name AS name_client, cl.email AS email_client, cl.age AS age_client, cl.workplace AS workplace_client, cl.phone1 AS phone1_client, cl.phone2 AS phone2_client, cl.nationality AS nationality_client, cl.households AS households_client, cl.total_amount AS total_amount_client, cl.score_risk AS score_risk_client, ac.name AS activity_client, fu.name AS funding_client, ri.name AS risk_client FROM clients cl, activities ac, fundings fu, risks ri WHERE cl.activity_id = ac.id AND cl.funding_id = fu.id AND cl.risk_id = ri.id ORDER BY id_client DESC';
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
