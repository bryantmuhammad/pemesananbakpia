<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->string('id_pemesanan', 15)->primary();
            $table->foreignId('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->double('total_harga');
            $table->double('ongkir');
            $table->string('ekspedisi', 30);
            $table->string('estimasi', 15);
            $table->integer('status');
            $table->dateTime('tanggal_pemesanan');
            $table->date('tanggal_diperlukan');
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
        Schema::dropIfExists('pemesanans');
    }
}
