<?php

namespace App\Imports;
ini_set('max_execution_time', 120);

use DateTime;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\{WithBatchInserts,WithValidation,WithChunkReading,ToModel};

//Inicio de la clase
class TransactionImport implements ToModel, WithBatchInserts, WithChunkReading, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //Inicio de la condición
        if ((!isset($row[0])) or $row[7] == 0 or (!isset($row[7]))) { //Verifica si el registro tiene vacío el campo identity o si los campos de tipo flotante son 0
            return null; //No guarda el registro y salta el siguiente
        }//Fin de la condición
        else{
            //Realiza la inserción del registro con datos sin espacios al principio o final
            $client = DB::table('clients')->where('identity','=',trim(mb_strtoupper($row[0],'UTF-8')))->first();
        }

        if(!$client){
            return null; //No guarda el registro y salta el siguiente
        }else{
            if (trim(mb_strtoupper($row[5])) == 'SI'  or trim(mb_strtoupper($row[5])) == 'SÍ' or trim(mb_strtoupper($row[5])) == 'YES' or trim(mb_strtoupper($row[5])) == 'TRUE' or trim(mb_strtoupper($row[5])) == 'AFIRMATIVO' or trim(mb_strtoupper($row[5])) == '1'){
                $boolValue = TRUE;
            }else{
                $boolValue = FALSE;
            }
            // dd($activityID);
            return new Transaction([
                'client_id'                     => $client->id,
                'user_id'                       => auth()->user()->id,
                'company_id'                    => auth()->user()->company_id,
                'activity_id'                   => $client->activity_id,
                'funding_id'                    => $client->funding_id,
                'transaction_apartment_number'  => trim(mb_strtoupper($row[1])),
                'transaction_intermediary_bank' => trim(mb_strtoupper($row[2])),
                'transaction_operation_date'    => trim($row[3]),
                'transaction_transfer_date'     => trim($row[4]),
                'transaction_cash'              => $boolValue,
                'transaction_currency'          => trim(mb_strtoupper($row[6])),
                'transaction_amount'            => (float)$row[7],
                'workplace'                     => $client->workplace,
                'workstation'                   => $client->workstation,
                'salary'                        => $client->salary,
            ]);
        }
    }//Fin de la función

    // Inicio de la función
    public function batchSize(): int
    {
        return 100;
    }//Fin de la función

    // Inicio de la función
    public function chunkSize(): int
    {
        return 100;
    }//Fin de la función

    public function rules(): array
    {
        return [
            // Siempre valida por lotes
            // Fila.columna
            '0.0' => 'in:identity',
            '0.1' => 'in:transaction_number',
            '0.2' => 'in:transaction_intermediary_bank',
            '0.3' => 'in:transaction_operation_date',
            '0.4' => 'in:transaction_transfer_date',
            '0.5' => 'in:transaction_cash',
            '0.6' => 'in:transaction_currency',
            '0.7' => 'in:transaction_amount',
        ];
    }
} //Fin de la clase
