<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Validator;
use App\Funding;
use App\Activity;
use Carbon\Carbon;
use App\Events\EventsSiplaft;
use Illuminate\Support\Facades\Auth;
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
        ->select('transactions.id AS id','transactions.apartment_number AS apartment_number',
                'transactions.intermediary_bank AS intermediary_bank', 'transactions.operation_date AS operation_date',
                'transactions.transfer_date AS transfer_date',
                'transactions.cash AS cash', 'transactions.currency AS currency',
                'transactions.amount AS amount', 'clients.identity AS client_identity', 'clients.name AS client_name',
                'users.name AS user_name', 'companies.id AS company_id', 'companies.name AS company_name')
        ->orderByDesc('operation_date')
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
        $sql = 'SELECT tr.id AS id, tr.apartment_number AS apartment_number, tr.intermediary_bank AS intermediary_bank, tr.operation_date AS operation_date,
                        tr.transfer_date AS transfer_date, tr.cash AS cash, tr.currency AS currency, tr.amount AS amount,
                        cl.identity AS client_identity, cl.name AS client_name, co.id AS company_id, co.name AS company_name, us.name AS user_name
                FROM transactions tr, users us, companies co, clients cl
                WHERE tr.user_id = us.id AND tr.company_id = co.id AND tr.client_id = cl.id
                ORDER BY operation_date DESC';
        $transactions = DB::select($sql);

        return $transactions; // Retorna la lista de transacciones
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $idClient)
    {
        $user_modifier_id = Auth::user()->id;
        $user_company = Auth::user()->company_id;
        $clientData = DB::table('clients')
                        ->where('id', $idClient)
                        ->first();
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_register = null;
        $record_new_data = null;
        $record_old_data = null;

        $validator = Validator::make($request->all(), [
            'apartment_number'      => 'required|max:10',
            'operation_date'        => 'required|date|before_or_equal:today',
            'transfer_date'         => 'date|before_or_equal:today',
            'intermediary_bank'     => 'string|max:20',
            'amount'                => 'required|numeric',
            'currency'              => 'string|max:20',
            'cash'                  => 'boolean',
        ]);

        if ($validator->fails()) {
            $record_action = 'FALLÓ REGISTRO DE TRANSACCIÓN';
            $record_modified_table = null;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action,
            'record_date' => $record_date , 'record_modified_table' => $record_modified_table,
            'record_modified_register' => $record_modified_register, 'record_new_data' => $record_new_data,
            'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
            return redirect('col.transaction.form')->withInput()->withErrors($validator);
        }else{
            Transaction::create([
                'client_id'             => $idClient,
                'user_id'               => $user_modifier_id,
                'company_id'            => $user_company,
                'activity_id'           => $clientData->activity_id,
                'funding_id'            => $clientData->funding_id,
                'apartment_number'      => $request['apartment_number'],
                'operation_date'        => $request['operation_date'],
                'transfer_date'         => $request['transfer_date'],
                'intermediary_bank'     => trim(mb_strtoupper($request['intermediary_bank'])),
                'amount'                => (float)$request['amount'],
                'currency'              => trim(mb_strtoupper($request['currency'])),
                'cash'                  => $request['cash'],
                'workplace'             => $clientData->workplace,
                'workstation'           => $clientData->workstation,
                'salary'                => $clientData->salary,
                ]);
                $record_modified_table = 'TRANSACTIONS';
                $record_action = 'REGISTRÓ NUEVA TRANSACCIÓN';
                $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
                event( new EventsSiplaft( $data ));
                $findLastRecord = DB::table('records')->latest('id')->first();
                $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
                $calculateData = DB::select('CALL calculateData (?)',array($idClient));
                return back()->with('message', 'Transacción registrada'); //Retorna a la página anterior cuando registra al usuario
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
    public function update(Request $request, $idTransaction){
    $user_modifier_id = Auth::user()->id;
    $record_date = Carbon::now()->toDateTimeString();
    $record_modified_table = 'TRANSACTIONS';
    $record_modified_register = null;
    $record_new_data = null;
    $record_old_data = null;

    $validator = Validator::make($request->all(), [
        'apartment_number'      => 'required|max:10',
        'operation_date'        => 'required|date|before_or_equal:today',
        'transfer_date'         => 'date|before_or_equal:today',
        'intermediary_bank'     => 'string|max:20',
        'amount'                => 'required|numeric',
        'currency'              => 'string|max:20',
        'cash'                  => 'boolean',
    ]);

    if ($validator->fails()) {
        $record_action = 'FALLÓ ACTUALIZACIÓN DE TRANSACCIÓN';
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
        $transactionUpdate = Transaction::find($idTransaction);
        $record_action = 'ACTUALIZÓ USUARIO';
        $record_modified_register = request()->apartment_number;
        if (request()->apartment_number != $transactionUpdate->apartment_number){
            $record_modified_field = 'apartment_number';
            $record_new_data = request()->apartment_number;
            $record_old_data = $transactionUpdate->apartment_number;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        };
        if (request()->operation_date != $transactionUpdate->operation_date ){
            $record_modified_field = 'operation_date';
            $record_new_data = request()->operation_date;
            $record_old_data = $transactionUpdate->operation_date;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        };
        if (request()->transfer_date != $transactionUpdate->transfer_date ){
            $record_modified_field = 'transfer_date';
            $record_new_data = request()->transfer_date;
            $record_old_data = $transactionUpdate->transfer_date;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        };
        if (request()->intermediary_bank != $transactionUpdate->intermediary_bank ){
            $record_modified_field = 'intermediary_bank';
            $record_new_data = request()->intermediary_bank;
            $record_old_data = $transactionUpdate->intermediary_bank;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        };
        if (request()->amount != $transactionUpdate->amount ){
            $record_modified_field = 'amount';
            $record_new_data = request()->amount;
            $record_old_data = $transactionUpdate->amount;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        };
        if (request()->currency != $transactionUpdate->currency ){
            $record_modified_field = 'currency';
            $record_new_data = request()->currency;
            $record_old_data = $transactionUpdate->currency;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        };
        if (request()->cash != $transactionUpdate->cash ){
            $record_modified_field = 'cash';
            $record_new_data = request()->cash;
            $record_old_data = $transactionUpdate->cash;
            $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
            event( new EventsSiplaft( $data ));
            $findLastRecord = DB::table('records')->latest('id')->first();
            $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);
        };
        $transactionUpdate->fill(request()->all());
        
        $transactionUpdate->save();
        return back()->with('message', 'Transacción Actualizada'); //Retorna a la página anterior cuando registra al usuario
    };
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
