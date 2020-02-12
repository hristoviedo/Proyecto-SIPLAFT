<?php

namespace App\Imports;

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

        //Realiza la inserción del registro con datos en mayúsculas y sin espacios al principio o final y con algunos elementos formateados.


        return new ClientsUpload([
            'identity'      => trim($row[0]),
            'name'          => trim(mb_strtoupper($row[1],'UTF-8')),
            'age'           => (int)$row[2],
            'email'         => trim($row[3]),
            'workplace'     => trim(mb_strtoupper($row[4],'UTF-8')),
            'workstation'   => trim(mb_strtoupper($row[5],'UTF-8')),
            'salary'        => (float)$row[6],
            'phone1'        => trim(strtoupper($row[7])),
            'phone2'        => trim(strtoupper($row[8])),
            'nationality'   => trim(mb_strtoupper($row[9],'UTF-8')),
            'households'    => (int)$row[10],
            'total_amount'  => (float)$row[11],
            'activity'      => trim(mb_strtoupper($row[12],'UTF-8')),
            'funding'       => trim(mb_strtoupper($row[13],'UTF-8')),
            ]);
        }//Fin de la función

        // Inicio de la función
        public function batchSize(): int
        {
            return 50;
        }//Fin de la función

        // Inicio de la función
        public function chunkSize(): int
        {
            return 50;
        }//Fin de la función

        // public function rules()
        // {
        //     return [
        //         'registration_number' => 'regex:/[A-Z]{3}-[0-9]{3}/',
        //         'doors' => 'in:2,4,6',
        //         'years' => 'between:1998,2017'
        //     ];
        // }


} //Fin de la clase
