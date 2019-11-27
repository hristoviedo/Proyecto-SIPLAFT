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
            $table->string('client_identity'); //Id del cliente (not null)
            $table->string('transaction_date'); //Fecha en que registró la transacción (not null)
            $table->string('transaction_cash')->default('NO'); //¿La transacción se hizo en efectivo? True si es verdadero (not null)
            $table->string('transaction_dollars')->default('NO'); //¿La transacción se hizo en dólares? YES si es verdadero (not null)
            $table->unsignedDecimal('transaction_amount_lempiras',12,2); //Monto de la transacción en lempiras (not null)
            $table->unsignedDecimal('transaction_amount_dollars',10,2); //Monto de la transacción en dólares (not null)
            $table->timestamps(); //Fecha de creación y modificación del registro
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
