<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Input extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_input', function (Blueprint $table) {
            $table->increments('id_input');
            $table->increments('id_kabupaten');
            $table->string('tanggal', 255);
            $table->string('positif', 255);
            $table->string('rawat', 255);
            $table->string('sembuh', 255);
            $table->string('meninggal', 255);

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
        //
        Schema::dropIfExists('tb_input');
    }
}
