<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Inicio de la clase
class Cliente extends Model
{
    //Permite la subida masiva de información a la base de datos. Deben estar todos los campos de la tabla clientes
    protected $fillable = ['identity','name','age','email','workplace','phone1','phone2','nationality','households','total_amount','activity','funding'];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
} //Fin de la clase
