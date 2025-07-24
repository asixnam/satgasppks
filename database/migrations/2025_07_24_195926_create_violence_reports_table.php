<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('violence_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_client');
            $table->uuid('id_reporter');
            $table->uuid('id_perpetrator');
            $table->uuid('id_violance');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('id_reporter')->references('id')->on('reporters')->onDelete('cascade');
            $table->foreign('id_perpetrator')->references('id')->on('perpetrators')->onDelete('cascade');
            $table->foreign('id_violance')->references('id')->on('violances')->onDelete('cascade');

            // Indexes untuk performance
            $table->index('id_client');
            $table->index('id_reporter');
            $table->index('id_perpetrator');
            $table->index('id_violance');
        });
    }

    public function down()
    {
        Schema::dropIfExists('violence_reports');
    }
};
