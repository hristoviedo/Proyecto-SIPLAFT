<?php

namespace App\Exports;

use App\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Cliente::all();
        return Cliente::select("id","identity","name","email")->get();
    }
}
