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
        Schema::create('table_daftar_poli', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('users'); 
            $table->foreignId('id_jadwal')->constrained('table_jadwal_periksa');
            $table->text('keluhan');
            $table->integer('no_antrian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_daftar_poli');
    }
};
