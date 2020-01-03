<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//Inicio de la clase
class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Inicio de la función up
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');//Número de registro en la base de datos, autoincremental
            $table->unsignedBigInteger('client_id')->nullable(); //Id del cliente (nullable)
            $table->unsignedBigInteger('user_id')->nullable(); //Id del usuario que lo registró (nullable)
            $table->unsignedBigInteger('company_id')->nullable(); //Id de la compañía donde se registró (nullable)
            $table->date('transaction_date'); //Fecha en que registró la transacción (not null)
            $table->boolean('transaction_cash'); //¿La transacción se hizo en efectivo? True si es verdadero (not null)
            $table->boolean('transaction_dollars'); //¿La transacción se hizo en lempiras? True si es verdadero (not null)
            $table->unsignedDecimal('transaction_amount_lempiras',12,2); //Monto de la transacción en lempiras (not null)
            $table->unsignedDecimal('transaction_amount_dollars',10,2); //Monto de la transacción en dólares (not null)

            $table->foreign('client_id')->references('id')->on('clients') //Relación con la tabla clients
                    ->onDelete('set null') //No borrar transacción
                    ->onUpdate('cascade'); //Actualizar en cascada

            $table->foreign('user_id')->references('id')->on('users') //Relación con la tabla users
                    ->onDelete('set null') //No borrar transaction
                    ->onUpdate('cascade');

            $table->foreign('company_id')->references('id')->on('companies') //Relación con la tabla companies
                    ->onDelete('set null') //No borrar transacción
                    ->onUpdate('cascade'); //Actualizar en cascada
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
        Schema::dropIfExists('transactions'); //Borra la tabla si existe
    }//Fin de la función
}//Fin de la clase
