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
        Schema::create('inputan_bidangs', function (Blueprint $table) {
            $table->id('id_inputan_bidang');
            $table->unsignedBigInteger('bidang_id');
            $table->string('ntpn');
            $table->double('jumlah');
            $table->date('tgl_setor');
            $table->text('uraian');
            $table->timestamps();

            $table->foreign('bidang_id')->references('id_bidang')->on('bidangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputan_bidangs');
    }
};
