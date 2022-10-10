<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_trans');
            $table->string('nama_pesanan');
            $table->string('menu');
            $table->string('nama_makanan')->nullable();
            $table->string('nama_minuman')->nullable();
            $table->string('nama_jusbuah')->nullable();
            $table->string('jumlah');
            $table->string('harga');
            $table->string('total_harga');
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
        Schema::dropIfExists('detail_transaksi_penjualans');
    }
}
