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
    // Schema::create('pemeriksaan', function (Blueprint $table) {
    //     $table->id();
    //     $table->foreignId('anak_id')->constrained('anak')->onDelete('cascade');
    //     $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade'); // role=petugas
    //     $table->date('tanggal');
    //     $table->float('berat_badan');
    //     $table->float('tinggi_badan');
    //     $table->float('lingkar_kepala')->nullable();
    //     $table->float('lingkar_lengan')->nullable();

    //     // status berdasarkan standar pertumbuhan WHO
    //     $table->enum('status_bbu', ['Gizi Baik', 'Gizi Kurang', 'Gizi Buruk', 'Gizi Lebih'])->nullable(); // Berat Badan per Umur
    //     $table->enum('status_tbu', ['Normal', 'Pendek', 'Tinggi'])->nullable(); // Tinggi Badan per Umur
    //     $table->enum('perubahan_bb', ['Naik', 'Turun', 'Tetap'])->nullable();
    //     $table->enum('perubahan_tb', ['Naik', 'Turun', 'Tetap'])->nullable();

    //     $table->text('keluhan')->nullable();
    //     $table->text('catatan')->nullable();
    //     $table->timestamps();
    // });

    Schema::create('pemeriksaan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('anak_id')->constrained('anak')->onDelete('cascade');
        $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade'); // role=petugas
        $table->date('tanggal');
        $table->float('berat_badan');
        $table->float('tinggi_badan');
        $table->float('lingkar_kepala')->nullable();
        $table->float('lingkar_lengan')->nullable();

        // status berdasarkan standar pertumbuhan WHO
        $table->enum('status_bbu', ['Gizi Baik', 'Gizi Kurang', 'Gizi Buruk', 'Gizi Lebih'])->nullable(); 
        $table->enum('status_tbu', ['Normal', 'Pendek', 'Tinggi'])->nullable();
        $table->enum('status_lk', ['Normal', 'Kurang', 'Lebih'])->nullable(); // Lingkar Kepala
        $table->enum('status_ll', ['Normal', 'Kurang', 'Lebih'])->nullable(); // Lingkar Lengan


        $table->enum('perubahan_bb', ['Naik', 'Turun', 'Tetap'])->nullable();
        $table->enum('perubahan_tb', ['Naik', 'Turun', 'Tetap'])->nullable();
        $table->enum('perubahan_lk', ['Naik', 'Turun', 'Tetap'])->nullable(); // perubahan lingkar kepala
        $table->enum('perubahan_ll', ['Naik', 'Turun', 'Tetap'])->nullable(); // perubahan lingkar lengan

        $table->text('keluhan')->nullable();
        $table->text('catatan')->nullable();
        $table->timestamps();
    });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
