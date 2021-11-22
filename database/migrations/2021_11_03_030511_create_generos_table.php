<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::table('artistas', function (Blueprint $table){
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id', 'foreing_genero')->references('id')
                ->on('generos')
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
        Schema::table('artistas', function (Blueprint $table){
            $table->dropForeign('foreing_genero');
            $table->dropColumn('genero_id');
        });
        Schema::dropIfExists('generos');
    }
}
