<?php
// File: database/migrations/xxxx_xx_xx_xxxxxx_create_galeri_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id('id_galeri');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeri');
    }
};