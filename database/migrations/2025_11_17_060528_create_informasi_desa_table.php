<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('informasi_desa', function (Blueprint $table) {
            $table->id('id_info');
            $table->string('judul');
            $table->text('isi');
            $table->string('kategori');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('informasi_desa');
    }
};