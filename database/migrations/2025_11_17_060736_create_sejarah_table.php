<?php
// File: database/migrations/xxxx_xx_xx_xxxxxx_create_sejarah_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sejarah', function (Blueprint $table) {
            $table->id('id_sejarah');
            $table->string('judul');
            $table->text('isi');
            $table->string('gambar');
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sejarah');
    }
};