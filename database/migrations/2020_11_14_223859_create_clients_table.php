<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//Inicio de la clase
class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Inicio de la función up
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id'); //Número de registro en la base de datos (autoincremental)
            $table->unsignedBigInteger('activity_id')->default(null)->nullable(); //Id de la actividad económica (valor por defecto = null, sin signo y nullable)
            $table->unsignedBigInteger('funding_id')->default(null)->nullable(); //Id de la fuente de financiamiento (valor por defecto = null, sin signo y nullable)
            $table->unsignedBigInteger('risk_id')->default(0)->nullable(); //Id del nivel de riesgo (valor por defecto = null, sin signo y nullable)
            $table->string('identity', 16); //Número de identidad del cliente (not null)
            $table->string('name', 70)->nullable(); //Nombre completo del cliente (not null)
            $table->unsignedInteger('age')->nullable(); //Edad en años (nullable)
            $table->string('email', 40)->nullable(); //Correo electrónico (nullable)
            $table->string('workplace', 30)->nullable(); //Lugar de trabajo (nullable)
            $table->string('workstation', 45)->nullable(); //Puesto de trabajo (nullable)
            $table->unsignedDecimal('salary',9,2)->nullable(); //Monto total del salario mensual (valor por defecto = 0.00 y nullable)
            $table->string('phone1', 15)->nullable(); //Teléfono principal (nullable)
            $table->string('phone2', 15)->nullable(); //Teléfono secundario (nullable)
            $table->string('nationality', 20)->nullable(); //Nacionalidad (nullable)
            $table->unsignedInteger('households')->default(null)->nullable(); //Cantidad de viviendas adquiridas (valor por defecto = null y nullable)
            $table->unsignedDecimal('total_amount',12,2)->default(null)->nullable(); //Monto total de dinero invertido (valor por defecto = 0.00 y nullable)
            $table->unsignedDecimal('score_risk', 3, 2)->default(null)->nullable(); //Puntuación de riesgo (valor por defecto = 0.00 y nullable)
            $table->timestamps(); //Fecha de creación y modificación del registro (valor por defecto = null y nullable)

            $table->foreign('activity_id')->references('id')->on('activities') //Relación con la tabla activities
                    ->onDelete('set null') //No borrar cliente
                    ->onUpdate('cascade'); //Actualizar en cascada

            $table->foreign('funding_id')->references('id')->on('fundings') //Relación con la tabla fundings
                    ->onDelete('set null') //No borrar cliente
                    ->onUpdate('cascade'); //Actualizar en cascada

            $table->foreign('risk_id')->references('id')->on('risks') //Relación con la tabla risks
                    ->onDelete('set null') //No borrar cliente
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
        Schema::dropIfExists('clients'); //Borra la tabla si existe
    }//Fin de la función
}//Fin de la clase
