<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id('id_tanggapan');
            $table->foreignId('id_pengaduan')->constrained('pengaduan', 'id_pengaduan');
            $table->foreignId('id_user')->constrained('users', 'id_user');
            $table->text('isi_tanggapan');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};