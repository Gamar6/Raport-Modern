<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('uas', function (Blueprint $table) {
            $table->id();
            $table->string('namaSiswa')->nullable(); 
            $table->integer('nilai');
            $table->string('mapel');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('uas');
    }
};
