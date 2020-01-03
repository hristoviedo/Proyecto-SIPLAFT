<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

//Inicio de la clase TransactionExport
class TransactionExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //Inicio de la funcion headings
    public function headings(): array{
        return [
            '#',
            '#_de_Cliente',
            '#_de_Usuario',
            '#_de_Compañía',
            'Fecha_de_Transacción',
            'Efectivo?',
            'Dolares?',
            'Monto en lempiras',
            'Monto en dolares',
        ]; //Asigna el encabezado predeterminado de los datos a exportar
    }//Fin de la funcion

    //Inicio de la funcion collection
    public function collection()
    {
        $data = DB::table('transactions')
                    ->whereYear('transaction_date', '2019')
                    ->whereMonth('transaction_date', '04')
                    ->get();
        return $data; //Retorna los datos de las transacciones segun el mes y año a reportar(Falta implementarlo)
    }//Fin de la funcion

    //Inicio de la funcion getCsvSettings
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '|'
        ]; //Indica el caracter delimitador para los datos
    }//Fin de la funcion
}//Fin de la clase
