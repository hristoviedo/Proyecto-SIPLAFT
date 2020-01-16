<?php

namespace App\Imports;

use App\ClientsUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

//Inicio de la clase
class ClientImport implements ToModel, WithBatchInserts, WithChunkReading
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
        if (((!isset($row[0]))) or (($row[2] == 0) and ($row[10] == 0))) { //Verifica si el registro tiene vacío el campo identity o si los campos de tipo enteros son 0
            return null; //No guarda el registro y salta el siguiente
        }//Fin de la condición

        //Se asigna el valor de cada campo en su respectiva variable
        $identity = $row[0];
        $name = $row[1];
        $age = $row[2];
        $email = $row[3];
        $workplace = $row[4];
        $workstation = $row[5];
        $salary = $row[6];
        $phone1 = $row[7];
        $phone2 = $row[8];
        $nationality = $row[9];
        $households = $row[10];
        $total_amount = $row[11];
        $activity = $row[12];
        $funding = $row[13];

        //Cambia el tipo de variable para que coincida con los predefinidos en la base de datos
        $age            = (int)$age;
        $salary         = (float)$salary;
        $households     = (int)$households;
        $total_amount   = (float)$total_amount;

        //Realiza la inserción del registro con datos en mayúsculas y sin espacios al principio o final
        return new ClientsUpload([
            'identity'      => trim($identity),
            'name'          => trim(mb_strtoupper($name,'UTF-8')),
            'age'           => $age,
            'email'         => trim($email),
            'workplace'     => trim(mb_strtoupper($workplace,'UTF-8')),
            'workstation'   => trim(mb_strtoupper($workstation,'UTF-8')),
            'salary'        => $salary,
            'phone1'        => trim(strtoupper($phone1)),
            'phone2'        => trim(strtoupper($phone2)),
            'nationality'   => trim(mb_strtoupper($nationality,'UTF-8')),
            'households'    => $households,
            'total_amount'  => $total_amount,
            'activity'      => trim(mb_strtoupper($activity,'UTF-8')),
            'funding'       => trim(mb_strtoupper($funding,'UTF-8')),
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
