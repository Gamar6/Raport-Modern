<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->unsignedBigInteger('pembina_id')->nullable()->after('siswa_id');
            $table->foreign('pembina_id')->references('id')->on('pembina')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::table('catatan_pembina', function (Blueprint $table) {
            $table->dropForeign(['pembina_id']);
            $table->dropColumn('pembina_id');
        });
    }
};
