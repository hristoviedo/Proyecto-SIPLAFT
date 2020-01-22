<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Inicio de la función risk
    public function users()
    {
        //Un cliente representa un tipo de riesgo
        return $this->hasMany(User::class);
    }
    //Fin de la función
}
