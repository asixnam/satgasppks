<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('status_korban', ['Disable', 'Tidak']);
            $table->string('kategori_disable')->nullable(); // hanya diisi jika status_korban = Disable
            $table->string('status'); // Mahasiswa, Dosen, Masyarakat, dll
            $table->text('sumber_informasi')->nullable(); // optional field

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
