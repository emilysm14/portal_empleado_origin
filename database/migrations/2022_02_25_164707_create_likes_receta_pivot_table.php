<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesRecetaPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes_receta', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->references('id')->on('users'); //llave foranea con la tabla id
            $table->foreignId('user_id')->constrained();
            $table->foreignId('receta_id')->constrained(); // este metodo es el mismo que el foreignId podemos usar cualquiera de los dos
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
        Schema::dropIfExists('likes_receta');
    }
}
