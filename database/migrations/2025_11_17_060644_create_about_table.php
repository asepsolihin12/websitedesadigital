<?php
// File: database/migrations/xxxx_xx_xx_xxxxxx_create_about_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->id('id_about');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about');
    }
};