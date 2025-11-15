<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penilaian_ekskul', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_ekskul_id');
            $table->integer('tingkat_partisipasi')->nullable();
            $table->string('tingkat_keterampilan')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->foreign('siswa_ekskul_id')
                ->references('id')->on('siswa_ekskul')
                ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('penilaian_ekskul');
    }
};
