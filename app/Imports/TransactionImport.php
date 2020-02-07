<?php

namespace App\Imports;

use App\TransactionsUpload;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

//Inicio de la clase
class TransactionImport implements ToModel, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //Inicio de la condición
        if ((!isset($row[0])) or $row[8] == 0) { //Verifica si el registro tiene vacío el campo identity o si los campos de tipo flotante son 0
            return null; //No guarda el registro y salta el siguiente
        }//Fin de la condición

        //Se asigna el valor de cada campo en su respectiva variable
        $client_identity = $row[0];
        $transaction_apartment_number = $row[1];
        $transaction_intermediary_bank = $row[2];
        $transaction_operation_date = $row[3];
        $transaction_transfer_date = $row[4];
        $transaction_cash = $row[5];
        $transaction_currency = $row[6];
        $transaction_amount = $row[7];

        //Cambia el tipo de variable para que coincida con los predefinidos en la base de datos
        $transaction_amount = (float)$transaction_amount;

        //Realiza la inserción del registro con datos sin espacios al principio o final
        return new TransactionsUpload([
            'client_identity'               => trim($client_identity),
            'transaction_apartment_number'  => trim(mb_strtoupper($transaction_apartment_number)),
            'transaction_intermediary_bank' => trim(mb_strtoupper($transaction_intermediary_bank)),
            'transaction_operation_date'    => trim($transaction_operation_date),
            'transaction_transfer_date'     => trim($transaction_transfer_date),
            'transaction_cash'              => trim(mb_strtoupper($transaction_cash)),
            'transaction_currency'          => trim(mb_strtoupper($transaction_currency)),
            'transaction_amount'            => $transaction_amount,
        ]);
    }//Fin de la función

    // Inicio de la función
    public function batchSize(): int
    {
        return 1;
    }//Fin de la función

    // Inicio de la función
    public function chunkSize(): int
    {
        return 1;
    }//Fin de la función
} //Fin de la clase
