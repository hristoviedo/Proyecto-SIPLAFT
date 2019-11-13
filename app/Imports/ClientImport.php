<?php

namespace App\Imports;

use App\ClientsUpload;
use Maatwebsite\Excel\Concerns\ToModel;


setlocale (LC_ALL, 'es_MX');

//Inicio de la clase
class ClientImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    //Inicio de la función
    public function model(array $row)
    {
        //Inicio de la condición
        if (((!isset($row[0]))) or (($row[2] == 0) and ($row[8] == 0))) { //Verifica si el registro tiene vacío el campo identity y name, o si los campos de tipo enteros son 0
            return null; //No guarda el registro y salta el siguiente
        }//Fin de la condición

        //Se asigna el valor de cada campo en su respectiva variable
        $identity = $row[0];
        $name = $row[1];
        $age = $row[2];
        $email = $row[3];
        $workplace = $row[4];
        $phone1 = $row[5];
        $phone2 = $row[6];
        $nationality = $row[7];
        $households = $row[8];
        $activity = $row[9];
        $funding = $row[10];

        //Cambia el tipo de variable para que coincida con los predefinidos en la base de datos
        $age = (int)$age;
        $households = (int)$households;

        //Realiza la inserción del registro con datos en mayúsculas y sin espacios al principio o final
        return new ClientsUpload([
            'identity'      => trim($identity),
            'name'          => trim(mb_strtoupper($name,'UTF-8')),
            'age'           => $age,
            'email'         => trim($email),
            'workplace'     => trim(mb_strtoupper($workplace,'UTF-8')),
            'phone1'        => trim(strtoupper($phone1)),
            'phone2'        => trim(strtoupper($phone2)),
            'nationality'   => trim(mb_strtoupper($nationality,'UTF-8')),
            'households'    => $households,
            'activity'      => trim(mb_strtoupper($activity,'UTF-8')),
            'funding'       => trim(mb_strtoupper($funding,'UTF-8')),
        ]);
    }//Fin de la función
} //Fin de la clase