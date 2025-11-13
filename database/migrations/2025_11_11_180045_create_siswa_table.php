<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable(); // relasi ke kelas
            $table->string('namaSiswa')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(); // tambahan kolom
            $table->integer('nis')->unique();
            $table->string('ekskul')->nullable();
            $table->string('prestasi')->nullable();
            $table->integer('nilaiUTS')->nullable();
            $table->integer('nilaiUAS')->nullable();
            $table->integer('rataNilai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('siswa');
    }
};
