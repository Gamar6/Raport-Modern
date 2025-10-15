<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('guru', function (Blueprint $table) {
        $table->unsignedBigInteger('id', true)->change(); // Mengubah tipe kolom id menjadi unsignedBigInteger
    });
}

public function down()
{
    Schema::table('guru', function (Blueprint $table) {
        $table->integer('id', true)->change(); // Mengembalikan tipe kolom id menjadi integer
    });
}

};
