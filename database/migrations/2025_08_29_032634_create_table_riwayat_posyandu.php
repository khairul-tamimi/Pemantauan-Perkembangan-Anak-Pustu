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
        Schema::create('riwayat_posyandu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anak')->onDelete('cascade');
            $table->date('tanggal');
            $table->float('berat_badan');   // kg
            $table->float('tinggi_badan');  // cm
            $table->float('lingkar_kepala')->nullable(); // cm
            $table->float('lingkar_lengan')->nullable(); // cm
            $table->string('sumber_data')->default('Buku KIA');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_posyandu');
    }
};
