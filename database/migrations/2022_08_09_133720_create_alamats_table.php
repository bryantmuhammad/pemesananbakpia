<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->bigIncrements('id_alamat');
            $table->string('id_pemesanan', 15);
            // $table->foreignId('id_pemesanan')->references('id_pemesanan')->on('pemesanans')->onDelete('cascade's);
            $table->string('provinsi', 20);
            $table->string('kabupaten', 20);
            $table->string('kodepos', 10);
            $table->string('kecamatan', 20);
            $table->string('alamat', 50);
            $table->timestamps();
        });


        Schema::table('alamats', function (Blueprint $table) {
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamats');
    }
}
