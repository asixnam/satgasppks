<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('perpetrators', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('hubungan_dengan_korban'); // Teman, Pacar, Dosen, dsb
            $table->string('nama'); // bisa nama/inisial/tidak tahu
            $table->string('telepon')->nullable(); // opsional, jika tidak tahu
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('keterangan'); // ciri-ciri pelaku
            $table->json('upload_bukti')->nullable(); // bukti: gambar, pdf, word

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perpetrators');
    }
};
