<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_data10s', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('agama_id')->unsigned();
            $table->string('foto_ktp')->nullable();
            $table->integer('umur');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('agama_id')->references('id')->on('agama10s');
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
        Schema::dropIfExists('detail_data10s');
    }
};
