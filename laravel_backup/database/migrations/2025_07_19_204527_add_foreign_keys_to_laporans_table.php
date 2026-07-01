<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            // Tambahkan kolom dengan tipe dan unsigned
            if (!Schema::hasColumn('laporans', 'pelapor_id')) {
                $table->unsignedBigInteger('pelapor_id')->nullable()->after('id');
                $table->foreign('pelapor_id')
                    ->references('id')
                    ->on('pelapors')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            }

            if (!Schema::hasColumn('laporans', 'klien_id')) {
                $table->unsignedBigInteger('klien_id')->nullable()->after('pelapor_id');
                $table->foreign('klien_id')
                    ->references('id')
                    ->on('kliens')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            }

            if (!Schema::hasColumn('laporans', 'informasi_kekerasan_id')) {
                $table->unsignedBigInteger('informasi_kekerasan_id')->nullable()->after('klien_id');
                $table->foreign('informasi_kekerasan_id')
                    ->references('id')
                    ->on('informasi_kekerasans')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign(['pelapor_id']);
            $table->dropForeign(['klien_id']);
            $table->dropForeign(['informasi_kekerasan_id']);

            $table->dropColumn(['pelapor_id', 'klien_id', 'informasi_kekerasan_id']);
        });
    }
};
