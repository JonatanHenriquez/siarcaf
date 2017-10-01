<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDietasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietas', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('asambleistas_id');
            $table->string('mes', 10)->nullable();
            $table->smallInteger('asistencia')->nullable();
            $table->boolean('junta_directiva')->nullable();
            $table->smallInteger('anio')->nullable();
			$table->timestamps();

            $table->index(["asambleistas_id"], 'fk_dietas_asambleistas1_idx');


            $table->foreign('asambleistas_id', 'fk_dietas_asambleistas1_idx')
                ->references('id')->on('asambleistas')
                ->onDelete('no action')
                ->onUpdate('no action');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dietas');
    }
}