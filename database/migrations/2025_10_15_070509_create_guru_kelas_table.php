<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruKelasTable extends Migration
{
public function up()
{
    Schema::create('guru_kelas', function (Blueprint $table) {
        $table->id(); // Menambahkan id untuk tabel guru_kelas
        $table->unsignedInteger('guru_id'); // Ubah tipe data guru_id menjadi unsignedInteger untuk sesuai dengan id di tabel guru
        $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
        $table->timestamps();
    });
}



    public function down()
    {
        Schema::dropIfExists('guru_kelas');
    }
}


