<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');//Número de registro en la base de datos, autoincremental
            $table->string('client_identity'); //Id del cliente
            $table->string('user_id'); //Id del usuario que lo registró
            $table->date('transaction_date'); //Fecha en que registró la transacción
            $table->boolean('cash'); //¿La transacción se hizo en efectivo? True si es verdadero
            $table->boolean('transaction_lempiras'); //¿La transacción se hizo en lempiras? True si es verdadero
            $table->unsignedDecimal('transaction_amount_lempiras',12,2); //Monto de la transacción en lempiras
            $table->unsignedDecimal('transaction_amount_dollars',10,2); //Monto de la transacción en dólares
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_uploads');
    }
}
