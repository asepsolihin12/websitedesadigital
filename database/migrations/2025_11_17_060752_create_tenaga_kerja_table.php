<?php
// File: database/migrations/xxxx_xx_xx_xxxxxx_create_tenaga_kerja_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenaga_kerja', function (Blueprint $table) {
            $table->id('id_tenaga');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('gambar');
            $table->text('bio');
            $table->string('kontak');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenaga_kerja');
    }
};