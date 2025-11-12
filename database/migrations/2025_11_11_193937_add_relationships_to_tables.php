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
            $table->foreign('user_id')->references('id')->on(table: 'users')->onDelete('cascade');
        });

        // Relasi PEMBINA ↔ USERS
        Schema::table('pembina', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Relasi SISWA ↔ USERS
        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Relasi KELAS ↔ GURU (wali kelas)
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('waliKelas_id')->references('id')->on('guru')->onDelete('set null');
        });

        // Relasi KELAS ↔ SISWA (opsional, kalau 1 siswa = 1 kelas)
        Schema::table('kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id')->nullable()->after('waliKelas_id');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('set null');
        });

        // Relasi EKSKUL ↔ PEMBINA dan SISWA
        Schema::table('ekskul', function (Blueprint $table) {
            $table->foreign('pembina_id')->references('id')->on('pembina')->onDelete('set null');
            $table->foreign('anggota_id')->references('id')->on('siswa')->onDelete('set null');
        });

        // Relasi UTS ↔ SISWA
        Schema::table('uts', function (Blueprint $table) {
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });

        // Relasi UAS ↔ SISWA
        Schema::table('uas', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id')->nullable()->after('id');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });

        // Relasi CATATAN PEMBINA ↔ SISWA
        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('pembina', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['waliKelas_id']);
            $table->dropForeign(['siswa_id']);
            $table->dropColumn(['waliKelas_id', 'siswa_id']);
        });

        Schema::table('ekskul', function (Blueprint $table) {
            $table->dropForeign(['pembina_id']);
            $table->dropForeign(['anggota_id']);
            $table->dropColumn(['pembina_id', 'anggota_id']);
        });

        Schema::table('uts', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn('siswa_id');
        });

        Schema::table('uas', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn('siswa_id');
        });

        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn('siswa_id');
        });
    }
};
