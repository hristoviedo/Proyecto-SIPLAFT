<?php

namespace App\Exports;

use App\Cliente;
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
        return Cliente::select("id","identity","name","email")->get(); //Retorna 4 datos del cliente

    }//Fin de la función
}//Fin de la clase
