<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//Inicio de la clase
class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Inicio de la función up
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');//Número de registro en la base de datos (autoincremental)
            $table->string('name', 35); //Nombre de la compañía (35 caracteres max, not null)
            $table->unsignedInteger('type')->nullable(); //Tipo de compañía, número dado por la autoridades competentes (nullable)
            $table->timestamps();
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
        Schema::dropIfExists('companies'); //Borra la tabla si existe
    }//Fin de la función
}//Fin de la clase
