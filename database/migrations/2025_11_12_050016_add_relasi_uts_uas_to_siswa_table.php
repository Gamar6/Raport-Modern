<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('siswa', function (Blueprint $table) {
            if (!Schema::hasColumn('siswa', 'uts_id')) {
                $table->unsignedBigInteger('uts_id')->nullable()->after('prestasi');
                $table->foreign('uts_id')->references('id')->on('uts')->onDelete('set null');
            }
            if (!Schema::hasColumn('siswa', 'uas_id')) {
                $table->unsignedBigInteger('uas_id')->nullable()->after('uts_id');
                $table->foreign('uas_id')->references('id')->on('uas')->onDelete('set null');
            }
        });

        Schema::table('uts', function (Blueprint $table) {
            if (!Schema::hasColumn('uts', 'catatan')) {
                $table->text('catatan')->nullable()->after('nilai');
            }
        });

        Schema::table('uas', function (Blueprint $table) {
            if (!Schema::hasColumn('uas', 'catatan')) {
                $table->text('catatan')->nullable()->after('nilai');
            }
        });
    }

    public function down(): void {
        Schema::table('siswa', function (Blueprint $table) {
            if (Schema::hasColumn('siswa', 'uts_id')) {
                $table->dropForeign(['uts_id']);
                $table->dropColumn('uts_id');
            }
            if (Schema::hasColumn('siswa', 'uas_id')) {
                $table->dropForeign(['uas_id']);
                $table->dropColumn('uas_id');
            }
        });

        Schema::table('uts', function (Blueprint $table) {
            if (Schema::hasColumn('uts', 'catatan')) {
                $table->dropColumn('catatan');
            }
        });

        Schema::table('uas', function (Blueprint $table) {
            if (Schema::hasColumn('uas', 'catatan')) {
                $table->dropColumn('catatan');
            }
        });
    }
};
