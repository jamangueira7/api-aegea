<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carro_id');

            $table->string('motorista',15);
            $table->string('endereco', 256);

            $table->dateTime('data_inc');
            $table->dateTime('data_pos');

            $table->float('latitude', 10,2);
            $table->float('longitude', 10, 2);

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
        Schema::dropIfExists('registros');
    }
}
