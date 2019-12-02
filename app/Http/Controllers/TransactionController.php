<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Client;
use App\User;
use App\Company;
use DB; // Permite ejecutar consultas o llamar a procedimientos muy fácil


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Inicio de la función index
    public function index()
    {
        // Ordena los transacciones de forma descendente y los agrupa de 10 en 10

        $transactions = DB::table('transactions')
        ->join('users','transactions.user_id','=','users.id')
        ->join('clients','transactions.client_id','=','clients.id')
        ->join('companies','transactions.company_id','=','companies.id')
        ->select('transactions.id AS transaction_id', 'transactions.transaction_date AS transaction_date', 'transactions.transaction_cash AS transaction_cash',
                'transactions.transaction_dollars AS transaction_dollars', 'transactions.transaction_amount_lempiras AS transaction_amount_lempiras',
                'transactions.transaction_amount_dollars AS transaction_amount_dollars', 'clients.identity AS client_identity', 'clients.name AS client_name',
                'users.name AS user_name', 'companies.name AS company_name')
        ->paginate(10);

        // Retorna la lista de clientes, el total y otros datos para la paginación
        return [
            'pagination' => [
                'total'        => $transactions->total(),
                'current_page' => $transactions->currentPage(),
                'per_page'     => $transactions->perPage(),
                'last_page'    => $transactions->lastPage(),
                'from'         => $transactions->firstItem(),
                'to'           => $transactions->lastItem(),
            ],
            'transactions' => $transactions,
        ];
    }

    // Inicio de la función indexTransactionsAll
    public function indexTransactionsAll()
    {
        // Selecciona todas las transacciones de la tabla
        $sql = 'SELECT tr.id AS transaction_id, ELT(MONTH(tr.transaction_date), "ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE") AS transaction_month,
                        ELT(tr.transaction_cash + 1, "NO", "SI") AS transaction_cash, ELT(tr.transaction_cash + 1, "NO", "SI") AS transaction_dollars, tr.transaction_amount_lempiras AS transaction_amount_lempiras,
                        tr.transaction_amount_dollars AS transaction_amount_dollars, cl.identity AS client_identity, cl.name AS client_name, co.name AS company_name, us.name AS user_name
                FROM transactions tr, users us, companies co, clients cl
                WHERE tr.user_id = us.id AND tr.company_id = co.id AND tr.client_id = cl.id';
        $transactions = DB::select($sql);

        return $transactions; // Retorna la lista de transacciones
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
