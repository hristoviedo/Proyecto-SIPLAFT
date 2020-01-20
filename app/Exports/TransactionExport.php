<?php

namespace App\Exports;

use App\Client;
use App\Funding;
use App\Activity;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
// use Maatwebsite\Excel\Concerns\WithMapping;


//Inicio de la clase TransactionExport
class TransactionExport implements WithHeadings, ShouldAutoSize, WithColumnFormatting, FromQuery
// , WithCustomCsvSettings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    //Inicio de la funcion headings
    public function headings(): array{
        return [
            '#',
            'Clientes',
            'No de Apartamento',
            'Fecha de Operación',
            'Monto de la_operacion',
            'Fecha de Traspaso de Escritura',
            'Banco Intermediario',
            'Fondos',
            'Forma de Pago',
            'Lugar de Trabajo',
            'Puesto',
            'Salario',
            'Fuente de Ingreso',
            'Edad',
            'Identidad',
            'No. de Apartamentos',
            'No. de Apartamentos Acumulados',
        ]; //Asigna el encabezado predeterminado de los datos a exportar
    }//Fin de la funcion

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'L' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
        ];
    }

    //Inicio de la funcion collection
    public function query()
    {
        DB::statement(DB::raw('SET @rownum = 0'));

        $data = DB::table('transactions')
                ->join('clients','transactions.client_id','=','clients.id')
                ->join('fundings','transactions.funding_id','=','fundings.id')
                ->join('activities','transactions.activity_id','=','activities.id')
                ->select(DB::raw('@rownum := @rownum + 1 as rownum'),'clients.name','transactions.transaction_apartment_number',
                        'transactions.transaction_operation_date','transactions.transaction_amount',
                        'transactions.transaction_transfer_date','transactions.transaction_intermediary_bank',
                        'transactions.workplace','transactions.workstation',
                        'transactions.salary','clients.age','clients.identity',
                        'transactions.transaction_quantity','clients.households','transactions.funding_id')
                ->whereMonth('transactions.transaction_operation_date', '=', '12')
                ->whereYear('transactions.transaction_operation_date', '=', '2016')
                ->get();
        return $data; //Retorna los datos de las transacciones segun el mes y año a reportar(Falta implementarlo)
    }//Fin de la funcion

    //Inicio de la funcion getCsvSettings
    // public function getCsvSettings(): array
    // {
    //     return [
    //         'delimiter' => '|'
    //     ]; //Indica el caracter delimitador para los datos
    //}Fin de la funcion
}//Fin de la clase
