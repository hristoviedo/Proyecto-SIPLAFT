<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//Inicio de la clase
class CreateClientsUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Inicio de la función up
    public function up()
    {
        Schema::create('clients_uploads', function (Blueprint $table) {
            $table->bigIncrements('id'); //Número de registro en la base de datos (autoincremental)
            $table->string('identity', 15); //Número de identidad del cliente (not null)
            $table->string('name', 45)->nullable(); //Nombre completo del cliente (not null)
            $table->unsignedInteger('age')->nullable(); //Edad en años (nullable)
            $table->string('email', 30)->nullable(); //Correo electrónico (nullable)
            $table->string('workplace', 30)->nullable(); //Lugar de trabajo (nullable)
            $table->string('workstation', 45)->nullable(); //Puesto de trabajo (nullable)
            $table->unsignedDecimal('salary',9,2)->default(null)->nullable(); //Monto total del salario mensual (valor por defecto = 0.00 y nullable)
            $table->string('phone1', 12)->nullable(); //Teléfono principal (nullable)
            $table->string('phone2', 12)->nullable(); //Teléfono secundario (nullable)
            $table->string('nationality', 20)->nullable(); //Nacionalidad (nullable)
            $table->string('activity')->default(null)->nullable(); //Actividad económica (valor por defecto = null, sin signo y nullable)
            $table->string('funding')->default(null)->nullable(); //Fuente de financiamiento (valor por defecto = null, sin signo y nullable)
            $table->unsignedInteger('households')->default(null)->nullable(); //Cantidad de viviendas adquiridas (valor por defecto = null y nullable)
            $table->unsignedDecimal('total_amount',11,2)->default(null)->nullable(); //Monto total de dinero invertido (valor por defecto = 0.00 y nullable)
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
        Schema::dropIfExists('clients_uploads'); //Borra la tabla si existe
    }//Fin de la función
}//Fin de la clase
