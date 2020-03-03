<?php

namespace App\Imports;

ini_set('max_execution_time', 180);
use App\Client;
use App\Funding;
use App\Activity;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\{WithChunkReading, ToModel, WithValidation};

//Inicio de la clase
class ClientImport implements ToModel, WithChunkReading, WithValidation
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
        if (((!isset($row[0]))) or $row[0] == 0 or ((!isset($row[13]))) or (((!isset($row[12]))))) { //Verifica si el registro tiene vacío el campo identity o si los campos de tipo enteros son 0
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
            $client->total_amount   = $previousTotalAamount + (float)$row[11];
            $client->save();
        }
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
            '0'     => 'required|max:16',
            '1'     => 'required|max:45',
            '2'     => 'required|max:3',
            '11'    => 'required|max:50',
            '12'    => 'required|max:50',
        ];
    }
} //Fin de la clase
