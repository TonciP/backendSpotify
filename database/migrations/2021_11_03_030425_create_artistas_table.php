<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::table('bibliotecas', function (Blueprint $table){
            $table->unsignedBigInteger('artista_id');
            $table->foreign('artista_id', 'foreing_artista')->references('id')
                ->on('artistas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bibliotecas', function (Blueprint $table){
            $table->dropForeign('foreing_artista');
            $table->dropColumn('artista_id');
        });
        Schema::dropIfExists('artistas');
    }
}
