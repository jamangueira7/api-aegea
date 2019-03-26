<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfocanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infocan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carro_id');

            $table->float('combustivel',10,2);

            $table->boolean('cinto');
            $table->boolean('freio');
            $table->boolean('limp');

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
        Schema::dropIfExists('infocan');
    }
}
