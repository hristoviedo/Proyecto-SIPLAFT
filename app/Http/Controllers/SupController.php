<?php

namespace App\Http\Controllers;

use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\EventsSIPLAFT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\TransactionsReportMonth;
use App\Exports\TransactionsReportAllSup;

//Inicio de la clase SupController
class SupController extends Controller
{
    // Inicio del constructor
    public function __construct()
    {
        $this->middleware('sup'); //Verifica que la solicitud proviene de un usuario registrado con el role de supervisor.
        $this->middleware('active'); //Verifica que la solicitud proviene de un usuario activo.
    }
    //Fin del constructor

    //Inicio de la función sup_client
    public function sup_client(){
        return view('sup_client'); //Muestra la vista de 'sup_client.blade.php'
    }
    //Fin de la función

    //Inicio de la función sup_transaction
    public function sup_transaction(){
        return view('sup_transaction'); //Muestra la vista de 'sup_transaction.blade.php'
    }
    //Fin de la función

    //Inicio de la función sup_transaction
    public function sup_report_all(){
        return view('sup_report_all'); //Muestra la vista de 'sup_transaction.blade.php'
    }
    //Fin de la función

    //Inicio de la función sup_transaction
    public function sup_report(){
        $companies = Company::all();
        return view('sup_report', compact('companies')); //Muestra la vista de 'sup_transaction.blade.php'
    }
    //Fin de la función

    //Inicio de la función transactionExportExcel
    public function transactionExportExcel(Request $request){
        $month = $request->input('month');
        $year = $request->input('year');
        $company_id = $request->input('company');
        $companyName = DB::table('companies')
            ->select('companies.name')
            ->where('companies.id','=',$company_id)
            ->value('name');
        $user_modifier_id = Auth::user()->id;
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_table = null;
        $record_action = 'DESCARGÓ REPORTE MENSUAL DE TRANSACCIONES';
        $record_modified_register = null;
        $record_modified_field = null;
        $record_new_data = null;
        $record_old_data = null;
        $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
        event( new EventsSIPLAFT( $data ));
        $findLastRecord = DB::table('records')->latest('id')->first();
        $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);

        return (new TransactionsReportMonth)->forCompanyName($companyName)->forMonth($month)->forYear($year)->forCompanyID($company_id)->download($companyName . '-'. 'REPORTE' . '-' . $month . '-' . $year . '.xlsx'); //Llama a la clase TransactionExport para crear y descargar la lista de transacciones en un excel.
    }//Fin de la función

    //Inicio de la función transactionExportAllExcel
    public function transactionExportAllExcel(){

        $user_modifier_id = Auth::user()->id;
        $record_date = Carbon::now()->toDateTimeString();
        $record_modified_table = null;
        $record_action = 'DESCARGÓ REPORTE TOTAL DE TRANSACCIONES';
        $record_modified_register = null;
        $record_modified_field = null;
        $record_new_data = null;
        $record_old_data = null;
        $data = array( 'user_modifier_id' => $user_modifier_id, 'record_action' => $record_action, 'record_date' => $record_date , 'record_modified_table' => $record_modified_table, 'record_modified_register' => $record_modified_register, 'record_modified_field'=> $record_modified_field, 'record_new_data' => $record_new_data, 'record_old_data' => $record_old_data );
        event( new EventsSIPLAFT( $data ));
        $findLastRecord = DB::table('records')->latest('id')->first();
        $deleteLastRecord = DB::table('records')->delete($findLastRecord->id);

        return (new TransactionsReportAllSup)->download('REPORTE-COMPLETO.xlsx'); //Llama a la clase TransactionExport para crear y descargar la lista de transacciones en un excel.
    }//Fin de la función
}//Fin de la clase
