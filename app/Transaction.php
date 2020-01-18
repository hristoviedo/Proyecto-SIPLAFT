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
        return $this->hasOne(User::class)->withTimestamps();
    }
    //Fin de la función

    //Inicio de la función companies
    public function companies()
    {
        //Una transacción pertenece a una compañía
        return $this->hasOne(Company::class)->withTimestamps();
    }
    //Fin de la función

    //Inicio de la función clients
    public function clients()
    {
        //Una transacción pertenece a un cliente
        return $this->hasOne(Client::class)->withTimestamps();
    }
    //Fin de la función

     //Inicio de la función funding
     public function funding()
     {
         //Una transacción tiene un tipo de fuente
         return $this->hasOne(Funding::class);
     }
     //Fin de la función

     //Inicio de la función activity
    public function activity()
    {
        //Una transacción tiene un tipo de actividad
        return $this->hasOne(Activity::class);
    }
    //Fin de la función

}//Fin de la clase
