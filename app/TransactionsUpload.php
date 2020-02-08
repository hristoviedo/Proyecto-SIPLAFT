<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionsUpload extends Model
{
    //Permite la subida masiva de información a la base de datos. Deben estar todos los campos de la tabla transacciones
    protected $fillable = ['client_identity', 'transaction_apartment_number', 'transaction_intermediary_bank', 'transaction_operation_date', 'transaction_transfer_date', 'transaction_cash','transaction_currency','transaction_amount'];
}
