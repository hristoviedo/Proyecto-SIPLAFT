<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');//Número de registro en la base de datos, autoincremental
            $table->unsignedBigInteger('client_id')->nullable(); //Id del cliente
            $table->unsignedBigInteger('user_id')->nullable(); //Id del usuario que lo registró
            $table->date('transaction_date'); //Fecha en que registró la transacción
            $table->boolean('cash'); //¿La transacción se hizo en efectivo? True si es verdadero
            $table->boolean('transaction_lempiras'); //¿La transacción se hizo en lempiras? True si es verdadero
            $table->unsignedDecimal('transaction_amount_lempiras',12,2); //Monto de la transacción en lempiras
            $table->unsignedDecimal('transaction_amount_dollars',10,2); //Monto de la transacción en dólares

            $table->foreign('client_id')->references('id')->on('clients')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
