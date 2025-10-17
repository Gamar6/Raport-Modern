<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCatatanNullableInNilaiTable extends Migration
{
    public function up()
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Mengubah kolom catatan menjadi nullable
            $table->string('catatan', 200)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Jika rollback, kembalikan kolom catatan menjadi NOT NULL
            $table->string('catatan', 200)->nullable(false)->change();
        });
    }
}
