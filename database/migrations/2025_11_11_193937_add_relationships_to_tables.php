<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Relasi GURU ↔ USERS
        Schema::table('guru', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Relasi PEMBINA ↔ USERS
        Schema::table('pembina', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Relasi SISWA ↔ USERS & KELAS
        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
        });

        // Relasi KELAS ↔ GURU (wali kelas)
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('waliKelas_id')->references('id')->on('guru')->onDelete('set null');
        });

        // Relasi EKSKUL ↔ PEMBINA dan SISWA
        Schema::table('ekskul', function (Blueprint $table) {
            $table->foreign('pembina_id')->references('id')->on('pembina')->onDelete('set null');
            $table->foreign('anggota_id')->references('id')->on('siswa')->onDelete('set null');
        });

        // Relasi UTS ↔ SISWA
        Schema::table('uts', function (Blueprint $table) {
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('set null');
        });

        // Relasi UAS ↔ SISWA
        Schema::table('uas', function (Blueprint $table) {
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('set null');
        });

        // Relasi CATATAN PEMBINA ↔ SISWA
        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['kelas_id']);
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['waliKelas_id']);
        });

        Schema::table('ekskul', function (Blueprint $table) {
            $table->dropForeign(['pembina_id']);
            $table->dropForeign(['anggota_id']);
        });

        Schema::table('uts', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
        });

        Schema::table('uas', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
        });

        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
        });
    }
};
