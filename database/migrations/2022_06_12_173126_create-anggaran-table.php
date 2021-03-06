<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggaran' ,function(Blueprint $table){
            $table->increments('id');
            $table->string('nama_anggaran');
            $table->string('deskripsi');
            $table->string('program_id');
            $table->string('nominal_max_anggaran')->nullable();
            $table->string('persen')->nullable();
            $table->string('max_orang')->nullable();
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
        Schema::dropIfExists('anggaran');
    }
}
