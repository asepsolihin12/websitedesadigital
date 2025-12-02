<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->foreignId('id_user')->constrained('users', 'id_user');
            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal');
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
};