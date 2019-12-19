<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;


class TransactionExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Transaction::all(); //Retorna todos los dato de todas las transacciones (Falta implementarlo)
    // }
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
        ];
    }

    public function collection()
    {
        $data = DB::table('transactions') //Retorna 4 datos de los clientes (Falta implementarlo)
                    ->whereYear('transaction_date', '2019')
                    ->whereMonth('transaction_date', '04')
                    ->get();
        return $data;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '|'
        ];
    }
}
