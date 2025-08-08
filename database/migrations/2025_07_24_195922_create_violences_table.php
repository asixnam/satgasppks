<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('violences', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('jenis_kekerasan'); // seksual, psikis, fisik, dll
            $table->json('bentuk_kekerasan'); // bentuk spesifik dalam jenis, misal: "Tatapan seksual", "Pemaksaan seksual"
            $table->string('lokasi_kejadian'); // rumah, kos, kampus, dll
            $table->dateTime('waktu_kejadian');
            $table->text('deskripsi_kekerasan'); // narasi kronologis dari pelapor

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('violences');
    }
};
