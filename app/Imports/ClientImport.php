<?php

namespace App\Imports;

use App\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;

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
        //Verifica si el registro tiene vacío el campo identity y name, o si los campos de tipo enteros son 0
        if (((!isset($row[0])) and (!isset($row[1]))) or (($row[2] == 0) and ($row[8] == 0))) {
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
        $total_amount = $row[9];
        $activity = $row[10];
        $funding = $row[11];

        //Cambia el tipo de variable para que coincida con los predefinidos en la base de datos
        $age = (int)$age;
        $households = (int)$households;
        $total_amount = (float)$total_amount;

        //Realiza la inserción del registro con datos en mayúsculas y sin espacios al principio o final
        return new Cliente([
            'identity'      => trim($identity),
            'name'          => trim(strtoupper($name)),
            'age'           => $age,
            'email'         => trim(strtoupper($email)),
            'workplace'     => trim(strtoupper($workplace)),
            'phone1'        => trim(strtoupper($phone1)),
            'phone2'        => trim(strtoupper($phone2)),
            'nationality'   => trim(strtoupper($nationality)),
            'households'    => $households,
            'total_amount'  => $total_amount,
            'activity'      => trim(strtoupper($activity)),
            'funding'       => trim(strtoupper($funding)),
        ]);
    }//Fin de la función
} //Fin de la clase