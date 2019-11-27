<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionsUpload extends Model
{
    //Permite la subida masiva de información a la base de datos. Deben estar todos los campos de la tabla clientes
    protected $fillable = ['client_identity','transaction_date','transaction_cash','transaction_dollars','transaction_amount_lempiras', 'transaction_amount_dollars'];
}
