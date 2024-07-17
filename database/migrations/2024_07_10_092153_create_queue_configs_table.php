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
        Schema::create('queue_configs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('wilayah', 13);
            $table->json('pelayanan_loket');
            $table->time('jam_buka')->default('07:30:00');
            $table->time('jam_tutup')->default('15:30:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue_configs');
    }
};
