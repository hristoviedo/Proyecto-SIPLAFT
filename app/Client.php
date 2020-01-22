<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Inicio de la clase
class Client extends Model
{

    /*
    Funciones que definen la relación de la tabla clients con el resto
    */

    //Inicio de la función transaccions
    public function transactions()
    {
        //Un cliente realiza muchas transacciones
        return $this->hasMany(Transaction::class)->withTimestamps();
    }
    //Fin de la función

    //Inicio de la función risk
    public function risks()
    {
        //Un cliente representa un tipo de riesgo
        return $this->belongsTo(Risk::class);
    }
    //Fin de la función

    //Inicio de la función funding
    public function fundings()
    {
        //Un cliente tiene un tipo de fuente
        return $this->belongsTo(Funding::class);
    }
    //Fin de la función

    //Inicio de la función activity
    public function activities()
    {
        //Un cliente tiene un tipo de actividad
        return $this->belongsTo(Activity::class);
    }
    //Fin de la función
}//Fin de la clase
