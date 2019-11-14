<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Inicio de la clase
class Client extends Model
{
    //Permite la subida masiva de información a la base de datos. Deben estar todos los campos de la tabla clientes
    //protected $fillable = ['identity','name','age','email','workplace','phone1','phone2','nationality','households','total_amount'];

    public function transactions()
    {
        return $this->belongsToMany('Transaction::class')->withTimestamps();
    }

    public function risk()
    {
        return $this->belongsTo('Risk::class');
    }

    public function funding()
    {
        return $this->belongsTo('Funding::class');
    }

    public function activity()
    {
        return $this->belongsTo('Activity::class');
    }
}//Fin de la clase
