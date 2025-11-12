<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ekskul', function (Blueprint $table) {
            $table->id();
            $table->string('namaEkskul');
            $table->unsignedBigInteger('pembina_id')->nullable();
            $table->unsignedBigInteger('anggota_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ekskul');
    }
};
