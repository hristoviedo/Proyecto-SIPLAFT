<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id'); //Número de registro en la base de datos
            $table->string('identity'); //Número de identidad del cliente
            $table->string('name'); //Nombre completo
            $table->integer('age'); //Edad (años)
            $table->string('email'); //Correo electrónico
            $table->string('phone1'); //Teléfono principal
            $table->string('phone2'); //Teléfono secundario
            $table->string('nationality'); //Nacionalidad
            $table->integer('households'); //Cantidad de viviendas adquiridas
            $table->decimal('total_amount',10,2); //Monto total de dinero invertido
            $table->string('activity'); //Actividad económica
            $table->string('funding'); //Fuente de financiamiento
            $table->decimal('score_risk', 3, 2); //Puntuación de riesgo
            $table->string('risk'); //Nivel de riesgo
            $table->string('registered_by'); //Usuario que lo registró
            $table->string('updated_by'); //Usuario que lo actualizó
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
        Schema::dropIfExists('clientes');
    }
}
