<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surat_online', function (Blueprint $table) {
            $table->id('id_surat');
            $table->foreignId('id_user')->constrained('users', 'id_user');
            $table->string('jenis_surat');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_online');
    }
};