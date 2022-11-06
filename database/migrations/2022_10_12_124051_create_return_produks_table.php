<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_produks', function (Blueprint $table) {
            $table->bigIncrements('id_return_produk');
            $table->foreignId('id_detail_pemesanan')->references('id_detail_pemesanan')->on('detail_pemesanans')->cascadeOnDelete();
            $table->foreignId('id_produk')->references('id_produk')->on('produks')->cascadeOnDelete();
            $table->smallInteger('status')->default(0);
            $table->integer('jumlah');
            $table->string('url', 100);
            $table->text('alasan');
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
        Schema::dropIfExists('return_produks');
    }
}
