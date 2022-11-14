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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->foreign('id_jurusan')->references('id')->on('jurusan');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('nisn');
            $table->string('no_seri_ijazah_smp');
            $table->string('sekolah_asal_smp');
            $table->string('no_ujian_nasional_smp');
            $table->integer('nik')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('kebutuhan_khusus')->nullable();
            $table->text('alamat');
            $table->string('transportasi_ke_sekolah');
            $table->string('jenis_tinggal');
            $table->string('no_telepon_rumah')->nullable();
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->boolean('penerima_kps');
            $table->string('no_kps')->nullable();
            $table->string('nama_ayah');
            $table->string('kebutuhan_khusus_ayah')->nullable();
            $table->string('pekerjaan_ayah');
            $table->string('pendidikan_ayah');
            $table->string('penghasilan_bulanan_ayah');
            $table->string('nama_ibu');
            $table->string('kebutuhan_khusus_ibu')->nullable();
            $table->string('pekerjaan_ibu');
            $table->string('pendidikan_ibu');
            $table->string('penghasilan_bulanan_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('penghasilan_bulanan_wali')->nullable();
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('jarak_ke_sekolah');
            $table->string('waktu_tempuh_ke_sekolah');
            $table->integer('jumlah_saudara_kandung');
            $table->string('foto')->nullable();
            $table->string('jurusan_dipilih');
            $table->boolean('aktif')->default(0);
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
        Schema::dropIfExists('siswa');
    }
};
