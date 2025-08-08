<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('violence_reports', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('id_client');
            $table->uuid('id_reporter');
            $table->uuid('id_perpetrator');
            $table->uuid('id_violence'); // perbaikan typo
            $table->enum('status', ['terlapor', 'diproses', 'ditolak', 'selesai'])->default('terlapor');
            $table->string('code', 25);
            $table->timestamps();

            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('id_reporter')->references('id')->on('reporters')->onDelete('cascade');
            $table->foreign('id_perpetrator')->references('id')->on('perpetrators')->onDelete('cascade');
            $table->foreign('id_violence')->references('id')->on('violences')->onDelete('cascade');

            $table->index('id_client');
            $table->index('id_reporter');
            $table->index('id_perpetrator');
            $table->index('id_violence');
        });
    }

    public function down()
    {
        Schema::dropIfExists('violence_reports');
    }
};
