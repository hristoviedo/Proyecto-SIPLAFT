<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function transactions()
    {
        //Una fuente tiene muchas transacciones
        return $this->hasMany(Transaction::class);
    }
    //Fin de la función

    //Inicio de la función activity
    public function users()
    {
        //Una fuente tiene muchos clientes
        return $this->hasMany(User::class);
    }
    //Fin de la función
}
