<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_ba_denda', function (Blueprint $table) {
            $table->id('id_detail_ba_denda');
            $table->unsignedBigInteger('ba_denda_id');
            $table->string('nama_terpidana')->nullable();
            $table->string('no_registrasi_tilang')->nullable();
            $table->string('no_pembayaran')->nullable();
            $table->string('tgl_bayar')->nullable();
            $table->string('tgl_putusan')->nullable();
            $table->string('denda_putusan')->nullable();
            $table->integer('biaya_perkara_putusan')->nullable();
            $table->integer('jumlah_denda_putusan')->nullable();
            $table->integer('denda_disetor')->nullable();
            $table->integer('biaya_perkara_disetor')->nullable();
            $table->string('ntpn')->nullable();
            $table->string('channel')->nullable();
            $table->timestamps();
            $table->foreign('ba_denda_id')->references('id_ba_denda')->on('ba_denda')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ba_denda');
    }
};
