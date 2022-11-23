<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            // $table->string('facebook')->nullable();
            $table->text('visi')->nullable();
            $table->boolean('izinkan_siswa_akses_rapor')->default(0);
            $table->text('pesan_sukses_mendaftar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
};
