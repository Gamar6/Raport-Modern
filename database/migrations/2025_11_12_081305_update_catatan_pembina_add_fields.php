<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->string('tingkat_partisipasi')->nullable()->after('namaAnggota');
            $table->string('tingkat_keterampilan')->after('tingkat_partisipasi');
            $table->text('potensi')->nullable()->after('catatan');
            $table->text('rekomendasi_pengembangan')->nullable()->after('potensi');
        });
    }

    public function down(): void {
        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->dropColumn(['tingkat_partisipasi', 'potensi', 'rekomendasi_pengembangan']);
        });
    }
};
