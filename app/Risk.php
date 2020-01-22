<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    //Inicio de la función risk
    public function clients()
    {
        //Un cliente representa un tipo de riesgo
        return $this->hasMany(Client::class);
    }
    //Fin de la función
}
