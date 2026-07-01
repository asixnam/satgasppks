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
        Schema::table('laporans', function (Blueprint $table) {
            // Tambah kolom jika belum ada
            if (!Schema::hasColumn('laporans', 'pelapor_id')) {
                $table->unsignedBigInteger('pelapor_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('laporans', 'klien_id')) {
                $table->unsignedBigInteger('klien_id')->nullable()->after('pelapor_id');
            }
            if (!Schema::hasColumn('laporans', 'informasi_kekerasan_id')) {
                $table->unsignedBigInteger('informasi_kekerasan_id')->nullable()->after('klien_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['pelapor_id', 'klien_id', 'informasi_kekerasan_id']);
        });
    }
};
