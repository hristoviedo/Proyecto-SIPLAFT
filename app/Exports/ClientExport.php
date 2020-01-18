<?php

namespace App\Exports;

use App\Client;
use Maatwebsite\Excel\Concerns\FromCollection;

//Inicio de la clase
class ClientExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    //Inicio de la función
    public function collection()
    {
        // return Cliente::all(); //Retorna todos los datos del cliente
        $sql = Client::whereMonth('created_at', '=', '2')->whereYear('created_at', '=', '2020')->get(); //Retorna 4 datos de los clientes (Falta implementarlo)
        return $sql;

    }//Fin de la función
}//Fin de la clase
