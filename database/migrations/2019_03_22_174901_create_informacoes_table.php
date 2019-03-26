<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carro_id');

            $table->float('odo',10,2);
            $table->float('odo_total',10,2);

            $table->integer('rpm');
            $table->integer('velocidade');

            $table->boolean('log');
            $table->boolean('ign');
            $table->boolean('gps');

            $table->foreign('carro_id')->references('id')->on('carros');
            $table->softDeletes();
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
        Schema::dropIfExists('informacoes');
    }
}
