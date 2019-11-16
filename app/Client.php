<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Inicio de la clase
class Client extends Model
{
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
