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
        $identity = $row[0];
        $name = $row[1];
        $age = $row[2];
        $email = $row[3];
        $phone1 = $row[4];
        $nationality = $row[5];
        $households = $row[6];
        $total_amount = $row[7];
        $activity = $row[8];
        $funding = $row[9];

        $age = (int)$age;
        $households = (int)$households;
        $total_amount = (float)$total_amount;

        return new Cliente([
            'identity'      => $identity,
            'name'          => $name,
            'age'           => $age,
            'email'         => $email,
            'phone1'        => $phone1,
            'nationality'   => $nationality,
            'households'    => $households,
            'total_amount'  => $total_amount,
            'activity'      => $activity,
            'funding'       => $funding,
        ]);
    }
}
