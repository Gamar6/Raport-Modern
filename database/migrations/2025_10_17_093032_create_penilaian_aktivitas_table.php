<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->integer('siswa_id');
            $table->unsignedInteger('pembina_id');
            $table->unsignedInteger('ekskul_id');
            $table->integer('partisipasi')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pembina_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ekskul_id')->references('id')->on('ekskul')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_aktivitas');
    }
};
