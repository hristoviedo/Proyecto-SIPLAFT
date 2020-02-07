<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//Inicio de la clase
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Inicio de la función up
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); //Número de registro en la base de datos (autoincremental)
            $table->unsignedBigInteger('role_id')->default(null)->nullable(); //Id del rol (valor por defecto = null, sin signo y nullable)
            $table->unsignedBigInteger('company_id')->default(null)->nullable(); //Id de la compañía(valor por defecto = null, sin signo y nullable)
            $table->string('name',45); //Nombre del usuario (45 caracteres max, not null)
            $table->string('email',40)->unique(); //Correo electrónico del usuario (único, not null).
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); //Contraseña para inicio de sesión
            $table->boolean('active')->nullable(); //¿El usuario está activo? True si es verdadero (not null)
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles') //Relación a la tabla roles
                    ->onDelete('set null') //No borrar usuario
                    ->onUpdate('cascade'); //Actualizar en cascada

            $table->foreign('company_id')->references('id')->on('companies')
                    ->onDelete('set null') //No borrar usuario
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
        Schema::dropIfExists('users'); //Borra la tabla si existe
    }//Fin de la función
}//Fin de la clase
