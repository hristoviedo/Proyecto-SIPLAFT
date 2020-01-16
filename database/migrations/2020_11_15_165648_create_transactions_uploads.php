<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//Inicio de la clase
class CreateTransactionsUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Inicio de la función up
    public function up()
    {
        Schema::create('transactions_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');//Número de registro en la base de datos, autoincremental
            $table->string('client_identity'); //Id del cliente (not null)
            $table->string('transaction_apartment_number'); //Número de apartamento (not null)
            $table->string('transaction_intermediary_bank'); //Número de apartamento (not null)
            $table->string('transaction_operation_date'); //Fecha en que registró la operación (not null)
            $table->string('transaction_transfer_date'); //Fecha en que registró el traspaso de escritura (not null)
            $table->unsignedInteger('transaction_quantity'); //Cantidad de viviendas
            $table->string('transaction_cash')->default('NO'); //¿La transacción se hizo en efectivo? True si es verdadero (not null)
            $table->string('transaction_currency'); //Tipo de moneda en que se hizo la transacción (not null)
            $table->unsignedDecimal('transaction_amount',12,2); //Monto de la transacción en lempiras (not null)
            $table->timestamps(); //Fecha de creación y modificación del registro
        });
    }//Fin de la función

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //Inicio de la función down
    public function down()
    {
        Schema::dropIfExists('transactions_uploads'); //Borra la tabla si existe
    }//Fin de la función
}//Fin de la clase
