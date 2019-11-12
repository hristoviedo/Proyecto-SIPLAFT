<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id'); //Número de registro en la base de datos (autoincremental)
            $table->unsignedInteger('activity_id')->default(null)->nullable(); //Id de la actividad económica (valor por defecto = null, sin signo y nullable)
            $table->unsignedInteger('risk_id')->default(null)->nullable(); //Id del nivel de riesgo (valor por defecto = null, sin signo y nullable)
            $table->unsignedInteger('funding_id')->default(null)->nullable(); //Id de la fuente de financiamiento (valor por defecto = null, sin signo y nullable)
            $table->string('identity', 15); //Número de identidad del cliente (not null)
            $table->string('name', 45)->nullable(); //Nombre completo del cliente (not null)
            $table->integer('age')->nullable(); //Edad en años (nullable)
            $table->string('email', 30)->nullable(); //Correo electrónico (nullable)
            $table->string('workplace', 30)->nullable(); //Lugar de trabajo (nullable)
            $table->string('phone1', 12)->nullable(); //Teléfono principal (nullable)
            $table->string('phone2', 12)->nullable(); //Teléfono secundario (nullable)
            $table->string('nationality', 20)->nullable(); //Nacionalidad (nullable)
            $table->integer('households')->default(null)->nullable(); //Cantidad de viviendas adquiridas (valor por defecto = null y nullable)
            $table->decimal('total_amount',11,2)->default(null)->nullable(); //Monto total de dinero invertido (valor por defecto = 0.00 y nullable)
            $table->decimal('score_risk', 3, 2)->default(null)->nullable(); //Puntuación de riesgo (valor por defecto = 0.00 y nullable)
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
        Schema::dropIfExists('clients');
    }
}
