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
            $table->bigIncrements('id'); //Número de registro en la base de datos (autoincremental)
            $table->string('identity')->nullable(); //Número de identidad del cliente (not null)
            $table->string('name')->nullable(); //Nombre completo (not null)
            $table->integer('age')->nullable(); //Edad en años (nullable)
            $table->string('email')->nullable(); //Correo electrónico (nullable)
            $table->string('workplace')->nullable(); //Lugar de trabajo (nullable)
            $table->string('phone1')->nullable(); //Teléfono principal (nullable)
            $table->string('phone2')->nullable(); //Teléfono secundario (nullable)
            $table->string('nationality')->nullable(); //Nacionalidad (nullable)
            $table->integer('households')->default(null)->nullable(); //Cantidad de viviendas adquiridas (valor por defecto = 0 y nullable)
            $table->decimal('total_amount',13,2)->default(null)->nullable(); //Monto total de dinero invertido (valor por defecto = 0.00 y nullable)
            $table->string('activity')->default(null)->nullable(); //Actividad económica (valor por defecto = null y nullable)
            $table->string('funding')->default(null)->nullable(); //Fuente de financiamiento (valor por defecto = null y nullable)
            $table->decimal('score_risk', 3, 2)->default(null)->nullable(); //Puntuación de riesgo (valor por defecto = 0.00 y nullable)
            $table->string('risk')->default(null)->nullable(); //Nivel de riesgo (valor por defecto = null y nullable)
            $table->string('registered_by')->default(null)->nullable(); //Usuario que lo registró (valor por defecto = null y nullable)
            $table->string('updated_by')->default(null)->nullable(); //Usuario que lo actualizó (valor por defecto = null y nullable)
            $table->timestamps(); //Fecha de creación y modificación del registro (valor por defecto = null y nullable)
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
