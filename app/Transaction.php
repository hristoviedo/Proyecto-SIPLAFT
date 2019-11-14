<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function users()
    {
        return $this->belongsToMany('User::class')->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany('Company::class')->withTimestamps();
    }

    public function clients()
    {
        return $this->belongsToMany('Client::class')->withTimestamps();
    }
}