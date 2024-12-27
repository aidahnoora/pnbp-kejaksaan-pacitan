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
        Schema::create('detail_setor_debet', function (Blueprint $table) {
            $table->id('id_detail_setor_debet');
            $table->unsignedBigInteger('setor_debet_id');
            $table->string('nama_terpidana')->nullable();
            $table->string('no_registrasi_tilang')->nullable();
            $table->string('no_pembayaran')->nullable();
            $table->date('tgl_penitipan')->nullable();
            $table->integer('jumlah_titipan')->nullable();
            $table->date('tgl_putusan')->nullable();
            $table->integer('denda_putusan')->nullable();
            $table->integer('biaya_perkara_putusan')->nullable();
            $table->integer('jumlah_denda_putusan')->nullable();
            $table->integer('kelebihan_kekurangan_bayar')->nullable();
            $table->integer('denda_disetor')->nullable();
            $table->integer('biaya_perkara_disetor')->nullable();
            $table->string('ntpn')->nullable();
            $table->timestamps();
            $table->foreign('setor_debet_id')->references('id_setor_debet')->on('setor_debet')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_setor_debet');
    }
};
