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
        if (((!isset($row[0]))) or (($row[4] == 0) and ($row[5] == 0))) { //Verifica si el registro tiene vacío el campo identity o si los campos de tipo flotante son 0
            return null; //No guarda el registro y salta el siguiente
        }//Fin de la condición

        //Se asigna el valor de cada campo en su respectiva variable
        $client_identity = $row[0];
        $transaction_date = $row[1];
        $transaction_cash = $row[2];
        $transaction_dollars = $row[3];
        $transaction_amount_lempiras = $row[4];
        $transaction_amount_dollars = $row[5];

        //Cambia el tipo de variable para que coincida con los predefinidos en la base de datos
        $transaction_amount_lempiras = (float)$transaction_amount_lempiras;
        $transaction_amount_dollars = (float)$transaction_amount_dollars;

        //Realiza la inserción del registro con datos sin espacios al principio o final
        return new TransactionsUpload([
            'client_identity'               => trim($client_identity),
            'transaction_date'              => trim($transaction_date),
            'transaction_cash'              => trim(mb_strtoupper($transaction_cash)),
            'transaction_dollars'           => trim(mb_strtoupper($transaction_dollars)),
            'transaction_amount_lempiras'   => $transaction_amount_lempiras,
            'transaction_amount_dollars'    => $transaction_amount_dollars,
        ]);
    }//Fin de la función

    // Inicio de la función
    public function batchSize(): int
    {
        return 10;
    }//Fin de la función

    // Inicio de la función
    public function chunkSize(): int
    {
        return 10;
    }//Fin de la función
} //Fin de la clase
