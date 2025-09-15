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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anak')->cascadeOnDelete(); 
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete(); // hanya user role=petugas
            $table->date('tanggal'); // tanggal konsultasi dibuat
            $table->text('keluhan')->nullable();  // keluhan utama dari orang tua
            $table->text('saran')->nullable();    // saran/respon umum dari petugas
            $table->text('catatan')->nullable();  // catatan tambahan
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
