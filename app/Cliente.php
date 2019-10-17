<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['identity','name','age','email', 'workplace','phone1','phone2','nationality','households','total_amount','activity','funding'];
}
