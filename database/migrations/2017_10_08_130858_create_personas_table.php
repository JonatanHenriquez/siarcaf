<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('primer_nombre', 15)->nullable();
            $table->string('segundo_nombre', 15)->nullable();
            $table->string('primer_apellido', 15)->nullable();
            $table->string('segundo_apellido', 15)->nullable();
            $table->char('dui', 9)->nullable();
            $table->char('nit', 14)->nullable();
            $table->string('foto', 45)->nullable();
            $table->string('afp', 45)->nullable();
            $table->string('cuenta', 45)->nullable();
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
        Schema::drop('personas');
    }
}
