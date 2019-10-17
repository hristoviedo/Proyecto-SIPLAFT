<?php

namespace App\Imports;

use App\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row[0]) & !isset($row[1])) {
            return null;
        }else{
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

            $age = (int)$age;
            $households = (int)$households;
            $total_amount = (float)$total_amount;

            return new Cliente([
                'identity'      => $identity,
                'name'          => $name,
                'age'           => $age,
                'email'         => $email,
                'workplace'     => $workplace,
                'phone1'        => $phone1,
                'phone2'        => $phone2,
                'nationality'   => $nationality,
                'households'    => $households,
                'total_amount'  => $total_amount,
                'activity'      => $activity,
                'funding'       => $funding,
            ]);
        }
    }
}