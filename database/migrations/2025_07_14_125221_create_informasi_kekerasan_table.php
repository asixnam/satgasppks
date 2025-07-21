<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('informasi_kekerasan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kekerasan');
            $table->string('lokus_kejadian');
            $table->dateTime('waktu_kejadian');
            $table->string('keterangan_pihak_ke3');
            $table->string('kategori_pidana');
            $table->string('bentuk_kekerasan');
            $table->text('narasi_kronologis');
            $table->unsignedBigInteger('pelapor_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_kekerasan');
    }
};
