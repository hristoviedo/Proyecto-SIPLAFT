<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Inicio de la clase Transaction
class Transaction extends Model
{
    protected $fillable = ['client_id', 'user_id', 'company_id', 'activity_id', 'funding_id','apartment_number', 'intermediary_bank', 'operation_date','transfer_date', 'cash','currency','amount', 'workplace', 'workstation', 'salary'];
    /*
    Funciones que definen la relación de la tabla transactions con el resto
    */
    public $timestamps = false;
    //Inicio de la función users
    public function users()
    {
        //Una transacción pertenece a un usuario
        return $this->belongsTo(User::class)->withTimestamps();
    }
    //Fin de la función

    //Inicio de la función companies
    public function companies()
    {
        //Una transacción pertenece a una compañía
        return $this->belongsTo(Company::class)->withTimestamps();
    }
    //Fin de la función

    //Inicio de la función clients
    public function clients()
    {
        //Una transacción pertenece a un cliente
        return $this->belongsTo(Client::class)->withTimestamps();
    }
    //Fin de la función

     //Inicio de la función funding
     public function fundings()
     {
         //Una transacción tiene un tipo de fuente
         return $this->belongsTo(Funding::class);
     }
     //Fin de la función

     //Inicio de la función activity
    public function activities()
    {
        //Una transacción tiene un tipo de actividad
        return $this->belongsTo(Activity::class);
    }
    //Fin de la función

}//Fin de la clase
