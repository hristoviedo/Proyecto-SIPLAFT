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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id'); //Id del cliente
            $table->unsignedBigInteger('user_id'); //Id del usuario que lo registró
            $table->date('transaction_date'); //Fecha en que registró la transacción
            $table->unsignedDecimal('transaction_amount',11,2); //Fecha en que registró la transacción
            $table->boolean('cash'); //¿La transacción se hizo en efectivo? True si es verdadero
            $table->timestamps();
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
