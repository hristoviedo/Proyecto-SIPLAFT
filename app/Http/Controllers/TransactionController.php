<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Permite ejecutar consultas o llamar a procedimientos muy fácil

//Inicio de la clase TransactionController
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('auth'); // Verifica que la solicitud por enviar proviene de un usuario autenticado o no.
    }//Fin del constructor

    // Inicio de la función index
    public function index()
    {
        // Ordena las transacciones de forma descendente y los agrupa de 15 en 15

        $transactions = DB::table('transactions')
        ->join('users','transactions.user_id','=','users.id')
        ->join('clients','transactions.client_id','=','clients.id')
        ->join('companies','transactions.company_id','=','companies.id')
        ->select('transactions.id AS transaction_id','transactions.transaction_apartment_number AS transaction_apartment_number',
                'transactions.transaction_intermediary_bank AS transaction_intermediary_bank', 'transactions.transaction_operation_date AS transaction_operation_date',
                'transactions.transaction_transfer_date AS transaction_transfer_date','transactions.transaction_quantity AS transaction_quantity',
                'transactions.transaction_cash AS transaction_cash', 'transactions.transaction_currency AS transaction_currency',
                'transactions.transaction_amount AS transaction_amount', 'clients.identity AS client_identity', 'clients.name AS client_name',
                'users.name AS user_name', 'companies.name AS company_name')
        ->orderByDesc('transaction_operation_date')
        ->paginate(20);

        // Retorna la lista de transaccione, el total de registros y otros datos para la paginación
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
        $sql = 'SELECT tr.id AS transaction_id, tr.transaction_apartment_number AS transaction_apartment_number, tr.transaction_intermediary_bank AS transaction_intermediary_bank, tr.transaction_operation_date AS transaction_operation_date,
                        tr.transaction_transfer_date AS transaction_transfer_date, tr.transaction_quantity AS transaction_quantity, tr.transaction_cash AS transaction_cash, tr.transaction_currency AS transaction_currency, tr.transaction_amount AS transaction_amount,
                        cl.identity AS client_identity, cl.name AS client_name, co.name AS company_name, us.name AS user_name
                FROM transactions tr, users us, companies co, clients cl
                WHERE tr.user_id = us.id AND tr.company_id = co.id AND tr.client_id = cl.id
                ORDER BY transaction_operation_date DESC';
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
}//Fin de la clase
