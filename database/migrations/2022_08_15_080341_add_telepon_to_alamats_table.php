<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeleponToAlamatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alamats', function (Blueprint $table) {
            $table->string('nama_penerima', 30);
            $table->string('telepon', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alamats', function (Blueprint $table) {
            $table->dropColumn('nama_penerima');
            $table->dropColumn('telepon');
        });
    }
}
