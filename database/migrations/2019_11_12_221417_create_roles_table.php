<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//Inicio de la clase
class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Inicio de la función up
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');//Número de registro en la base de datos (autoincremental)
            $table->string('name', 15); //Nombre del rol (15 caracteres max, not null)
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
        Schema::dropIfExists('roles'); //Borra la tabla si existe
    }//Fin de la función
}//Fin de la clase
