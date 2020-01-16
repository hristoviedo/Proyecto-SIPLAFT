<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsUpload extends Model
{
    //Permite la subida masiva de información a la base de datos. Deben estar todos los campos de la tabla clients
    protected $fillable = ['identity','name','age','email','workplace', 'workstation', 'salary','phone1','phone2','nationality','households','total_amount','activity','funding'];
}
