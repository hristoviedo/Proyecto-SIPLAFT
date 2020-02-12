<?php

namespace App\Imports;

ini_set('max_execution_time', 180);
use App\Client;
use App\Funding;
use App\Activity;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\{WithChunkReading, WithBatchInserts, ToModel, WithValidation};

//Inicio de la clase
class ClientImport implements ToModel, WithBatchInserts, WithChunkReading, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    // Inicio de la función model
    public function model(array $row)
    {
        //Inicio de la condición
        if (((!isset($row[0]))) or $row[0] == 0 or ((!isset($row[13]))) or (((!isset($row[2]))) or ((!isset($row[10]))))) { //Verifica si el registro tiene vacío el campo identity o si los campos de tipo enteros son 0
            return null; //No guarda el registro y salta el siguiente
        }//Fin de la condición
        else{
            $client = Client::where('identity','=',trim($row[0]))->first();
            $activityID = DB::table('activities')->where('name','=',trim(mb_strtoupper($row[12],'UTF-8')))->value('id');
            $fundingID  = DB::table('fundings')->where('name','=',trim(mb_strtoupper($row[13],'UTF-8')))->value('id');
        }
        if(!$client){
            // dd($client);
            //Realiza la inserción del registro con datos en mayúsculas y sin espacios al principio o final y con algunos elementos formateados.
            return new Client([
                'activity_id'       => $activityID,
                'funding_id'        => $fundingID,
                'identity'          => trim($row[0]),
                'name'              => trim(mb_strtoupper($row[1],'UTF-8')),
                'age'               => (int)$row[2],
                'email'             => trim($row[3]),
                'workplace'         => trim(mb_strtoupper($row[4],'UTF-8')),
                'workstation'       => trim(mb_strtoupper($row[5],'UTF-8')),
                'salary'            => (float)$row[6],
                'phone1'            => trim(strtoupper($row[7])),
                'phone2'            => trim(strtoupper($row[8])),
                'nationality'       => trim(mb_strtoupper($row[9],'UTF-8')),
                'households'        => (int)$row[10],
                'total_amount'      => (float)$row[11],
                ]);
            }else{
            $previousHouseholds             = $client->households;
            $previousTotalAamount           = $client->total_amount;

            $client->activity_id    = $activityID;
            $client->funding_id     = $fundingID;
            $client->name           = trim(mb_strtoupper($row[1],'UTF-8'));
            $client->age            = (int)$row[2];
            $client->email          = trim($row[3]);
            $client->workplace      = trim(mb_strtoupper($row[4],'UTF-8'));
            $client->workstation    = trim(mb_strtoupper($row[5],'UTF-8'));
            $client->salary         = (float)$row[6];
            $client->phone1         = trim(strtoupper($row[7]));
            $client->phone2         = trim(strtoupper($row[8]));
            $client->nationality    = trim(mb_strtoupper($row[9],'UTF-8'));
            $client->households     = $previousHouseholds + (int)$row[10];
            $client->total_amount   = $previousTotalAamount + (float)$row[11];
            $client->save();
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
            '0.1' => 'in:name',
            '0.2' => 'in:age',
            '0.3' => 'in:email',
            '0.4' => 'in:workplace',
            '0.5' => 'in:workstation',
            '0.6' => 'in:salary',
            '0.7' => 'in:phone1',
            '0.8' => 'in:phone2',
            '0.9' => 'in:nationality',
            '0.10' => 'in:households',
            '0.11' => 'in:total_amount',
            '0.12' => 'in:activity',
            '0.13' => 'in:funding',
        ];
    }
} //Fin de la clase
