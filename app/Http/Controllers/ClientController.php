<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Activity;
use App\Funding;
use App\Risk;


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
        $clients = Client::orderBy('id', 'DESC')->paginate(10);

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
        $clients = Client::get();

        return $clients; // Retorna la lista de clientes
    }

    public function indexRisk()
    {
        // Selecciona todos los riesgos de la tabla
        $risks = Risk::get();

        return $risks; // Retorna la lista de riesgos
    }

    public function indexFunding()
    {
        // Selecciona todos las fuentes de financiamientos de la tabla
        $fundings = Funding::get();

        return $fundings; // Retorna la lista de fuentes
    }

    public function indexActivity()
    {
        // Selecciona todas las actividades financieras de la tabla
        $activities = Activity::get();

        return $activities; // Retorna la lista de actividades
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
