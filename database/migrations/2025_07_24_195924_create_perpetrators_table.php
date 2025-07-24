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
            $table->string('hubungan_dengan_korban');
            $table->string('nik_pelaku')->nullable();
            $table->string('nama_pelaku');
            $table->string('jenis_kelamin_pelaku');
            $table->integer('umur_pelaku')->nullable();
            $table->string('tempat_lahir_pelaku')->nullable();
            $table->date('tanggal_lahir_pelaku')->nullable();
            $table->string('agama_pelaku')->nullable();
            $table->string('status_perkawinan_pelaku')->nullable();
            $table->string('pendidikan_pelaku')->nullable();
            $table->string('pekerjaan_pelaku')->nullable();
            $table->text('alamat_pelaku')->nullable();
            $table->string('telepon_pelaku')->nullable();
            $table->string('jenis_kekerasan');
            $table->dateTime('waktu_kejadian')->nullable();
            $table->text('tempat_kejadian')->nullable();
            $table->text('kronologi');
            $table->text('keterangan_tambahan')->nullable();
            $table->json('upload_bukti')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perpetrators');
    }
};
