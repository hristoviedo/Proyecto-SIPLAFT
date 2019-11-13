<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_uploads', function (Blueprint $table) {
            $table->bigIncrements('id'); //Número de registro en la base de datos (autoincremental)
            $table->string('identity', 15); //Número de identidad del cliente (not null)
            $table->string('name', 45)->nullable(); //Nombre completo del cliente (not null)
            $table->unsignedInteger('age')->nullable(); //Edad en años (nullable)
            $table->string('email', 30)->nullable(); //Correo electrónico (nullable)
            $table->string('workplace', 30)->nullable(); //Lugar de trabajo (nullable)
            $table->string('phone1', 12)->nullable(); //Teléfono principal (nullable)
            $table->string('phone2', 12)->nullable(); //Teléfono secundario (nullable)
            $table->string('nationality', 20)->nullable(); //Nacionalidad (nullable)
            $table->string('activity')->default(null)->nullable(); //Actividad económica (valor por defecto = null, sin signo y nullable)
            $table->string('funding')->default(null)->nullable(); //Fuente de financiamiento (valor por defecto = null, sin signo y nullable)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_uploads');
    }
}
