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
        Schema::create('standar_pertumbuhan', function (Blueprint $table) {
                    $table->id();
                    $table->enum('jenis_kelamin', ['L', 'P']); // Laki-laki, Perempuan
                    $table->integer('usia_bulan'); // umur anak dalam bulan

                    $table->float('bb_min')->nullable(); // Berat badan minimum normal
                    $table->float('bb_max')->nullable(); // Berat badan maksimum normal
                    $table->float('tb_min')->nullable(); // Tinggi badan minimum normal
                    $table->float('tb_max')->nullable(); // Tinggi badan maksimum normal
                    $table->float('lk_min')->nullable(); // Lingkar kepala minimum
                    $table->float('lk_max')->nullable(); // Lingkar kepala maksimum
                    $table->float('ll_min')->nullable(); // Lingkar lengan minimum
                    $table->float('ll_max')->nullable(); // Lingkar lengan maksimum

                    $table->timestamps();
                });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standar_pertumbuhan');
    }
};
