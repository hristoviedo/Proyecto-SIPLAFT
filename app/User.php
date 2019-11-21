<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    Funciones que definen la relación de la tabla transactions con el resto
    */

    //Inicio de la función transactions
    public function transactions()
    {
        //Un usuario realiza muchas transacciones
        return $this->belongsToMany('Transaction::class')->withTimestamps();
    }
    //Fin de la función

    //Inicio de la función role
    public function role()
    {
        return $this->belongsTo('Role::class');
    }
    //Fin de la función

    //Inicio de la función company
    public function company()
    {
        return $this->belongsTo('Company::class');
    }
    //Fin de la función
}
