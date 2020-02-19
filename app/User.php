<?php

namespace App;

use App\Notifications\MyResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

     // Función copiada del archivo:
     // vendor\laravel\framework\src\Illuminate\Auth\Passwords\CanResetPassword.php
     /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    //Permite la subida masiva de información a la base de datos. Deben estar todos los campos de la tabla users
    protected $fillable = [
        'role_id','company_id','name', 'email', 'password','active'
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
        //Un usuario registra muchas transacciones
        return $this->hasMany('Transaction::class')->withTimestamps();
    }
    //Fin de la función

    //Inicio de la función role
    public function roles()
    {
        return $this->hasOne('Role::class');
    }
    //Fin de la función

    //Inicio de la función company
    public function companies()
    {
        return $this->hasOne('Company::class');
    }
    //Fin de la función
}
