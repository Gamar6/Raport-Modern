<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('namaGuru');
            $table->string('mapel');
            $table->string('nip')->unique();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('guru');
    }
};
