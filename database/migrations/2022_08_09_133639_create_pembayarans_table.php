<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->string('id_pemesanan', 15);
            $table->decimal('total_bayar');
            $table->dateTime('tanggal_pembayaran');
            $table->string('bank_tujuan', 10);
            $table->string('va_number', 30);
            $table->string('pdf', 100);
            $table->timestamps();
        });

        Schema::table('pembayarans', function (Blueprint $table) {
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
        Schema::dropIfExists('pembayarans');
    }
}
