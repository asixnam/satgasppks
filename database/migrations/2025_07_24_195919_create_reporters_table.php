<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reporters', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('hubungan_pelapor_dengan_pelaku'); // dropdown dengan "lainnya" bisa diketik
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('usia');
            $table->string('status_pelapor'); // Teman, Masyarakat, Tendik, Dosen, dll
            $table->string('no_telepon'); // bisa nullable kalau mau, tapi di data wajib
            $table->string('email');
            $table->text('alamat');
            $table->text('keterangan_tambahan')->nullable(); // opsional

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reporters');
    }
};
