<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id'); //Número de registro en la base de datos (autoincremental)
            $table->unsignedBigInteger('user_modifier_id')->default(null)->nullable(); //Id del rol (valor por defecto = null, sin signo y nullable)
            $table->string('record_action',45); //Nombre del usuario (45 caracteres max, not null)
            $table->string('record_date'); //Fecha en que se realizó la acción
            $table->string('record_modified_table')->default(null)->nullable();//Tabla que sufrió cambios
            $table->string('record_modified_register')->default(null)->nullable(); //Registro que sufrió cambios
            $table->string('record_modified_field')->default(null)->nullable(); //Campo que sufrió cambios
            $table->string('record_new_data',45)->default(null)->nullable(); //Nombre del usuario (45 caracteres max, not null)
            $table->string('record_old_data',45)->default(null)->nullable(); //Nombre del usuario (45 caracteres max, not null)

            $table->foreign('user_modifier_id')->references('id')->on('users') //Relación a la tabla roles
                    ->onDelete('set null') //No borrar usuario
                    ->onUpdate('cascade'); //Actualizar en cascada
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
