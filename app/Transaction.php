<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Inicio de la clase Transaction
class Transaction extends Model
{
    /*
    Funciones que definen la relación de la tabla transactions con el resto
    */

    //Inicio de la función users
    public function users()
    {
        //Una transacción pertenece a un usuario
        return $this->belongsTo('User::class')->withTimestamps();
    }
    //Fin de la función
    
    //Inicio de la función companies
    public function companies()
    {
        //Una transacción pertenece a una compañía
        return $this->belongsTo('Company::class')->withTimestamps();
    }
    //Fin de la función
    
    //Inicio de la función clients
    public function clients()
    {
        //Una transacción pertenece a un cliente
        return $this->belongsTo('Client::class')->withTimestamps();
    }
    //Fin de la función

}//Fin de la clase