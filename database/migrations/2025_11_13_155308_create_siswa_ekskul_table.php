<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('siswa_ekskul', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('ekskul_id');
            $table->timestamps();
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('ekskul_id')->references('id')->on('ekskul')->onDelete('cascade');
            $table->unique(['siswa_id', 'ekskul_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('siswa_ekskul');
    }
};
