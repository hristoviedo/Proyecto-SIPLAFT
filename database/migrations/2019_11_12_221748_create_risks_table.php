<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->bigIncrements('id');//Número de registro en la base de datos (autoincremental)
            $table->string('name', 15); //Nombre del riesgo (15 caracteres max.)
            $table->unsignedDecimal('minimum_value',3,2)->default(null)->nullable(); //Valor mínimo del riesgo (nullable)
            $table->unsignedDecimal('maximum_value',3,2)->default(null)->nullable(); //Valor máximo del riesgo (nullable)
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
        Schema::dropIfExists('risks');
    }
}
