<?php
// File: database/migrations/xxxx_xx_xx_xxxxxx_create_heroes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id('id_hero');
            $table->string('judul');
            $table->string('subjudul');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('heroes');
    }
};
