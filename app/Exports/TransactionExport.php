<?php

namespace App\Exports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
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
            'Fecha_de_Transacción',
            '#_de_Compañía',
            '#_de_Usuario'
        ];
    }

    public function collection()
    {
        return Transaction::select("id","transaction_date","company_id","user_id")->get(); //Retorna 4 datos de los clientes (Falta implementarlo)
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '|'
        ];
    }
}
