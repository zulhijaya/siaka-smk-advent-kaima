<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\Guru\NilaiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\Guru\AbsensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/storage', function () {
    Artisan::call('storage:link');

    return 'ok';
});

Route::get('redirect', [UserController::class, 'redirect']);

Route::get('', [HomeController::class, 'index'])->name('index');

Route::get('calon-siswa/daftar', [SiswaController::class, 'daftarSiswaBaru'])->name('calon-siswa.tambah')->middleware('guest');
Route::post('calon-siswa', [SiswaController::class, 'simpan'])->name('calon-siswa.simpan');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('edit', [UserController::class, 'editPassword'])->name('edit-password');
        Route::post('', [UserController::class, 'updatePassword'])->name('update-password');
    });

    Route::prefix('siswa')->name('siswa.')->group(function() {
        Route::get('/calon-siswa', [SiswaController::class, 'calonSiswa'])->name('calon-siswa');
        Route::get('/siswa-aktif', [SiswaController::class, 'siswaAktif'])->name('siswa-aktif');
        Route::get('/tambah', [SiswaController::class, 'tambah'])->name('tambah');
        Route::post('', [SiswaController::class, 'simpan'])->name('simpan');
        Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('{siswa}', [SiswaController::class, 'update'])->name('update');
        Route::delete('{siswa}', [SiswaController::class, 'destroy'])->name('destroy');
        Route::get('jadwal-mapel', [SiswaController::class, 'jadwalMapel'])->name('jadwal-mapel');
        Route::get('nilai', [SiswaController::class, 'nilai'])->name('nilai');
        Route::get('absensi', [SiswaController::class, 'absensi'])->name('absensi');
        Route::get('tagihan', [SiswaController::class, 'tagihan'])->name('tagihan');
        Route::get('{siswa}', [SiswaController::class, 'detail'])->name('detail');
    });
    Route::prefix('guru')->name('guru.')->group(function() {
        Route::get('', [GuruController::class, 'index'])->name('index');
        Route::get('/tambah', [GuruController::class, 'tambah'])->name('tambah');
        Route::post('', [GuruController::class, 'simpan'])->name('simpan');
        Route::get('/{guru}/edit', [GuruController::class, 'edit'])->name('edit');
        Route::put('/{guru}', [GuruController::class, 'update'])->name('update');
        Route::delete('{guru}', [GuruController::class, 'destroy'])->name('destroy');
        // Route::get('nilai-dan-absen', [GuruController::class, 'nilaiDanAbsen'])->name('nilai-dan-absen');
        Route::get('jadwal-mengajar', [GuruController::class, 'jadwalMengajar'])->name('jadwal-mengajar');
        Route::name('nilai.')->group(function() {
            Route::get('nilai', [NilaiController::class, 'inputNilai'])->name('input-nilai');
            Route::get('nilai/{jadwal}', [NilaiController::class, 'index'])->name('index');
            Route::get('nilai/{siswa}/{jadwal}/tambah', [NilaiController::class, 'tambah'])->name('tambah');
            Route::post('nilai/{siswa}/{jadwal}', [NilaiController::class, 'simpan'])->name('simpan');
            Route::get('nilai/{id_jadwal}/{nilai}/edit', [NilaiController::class, 'edit'])->name('edit');
            Route::put('nilai/{id_jadwal}/{nilai}', [NilaiController::class, 'update'])->name('update');
        });
        Route::name('absensi.')->group(function() {
            Route::get('absensi', [AbsensiController::class, 'inputAbsensi'])->name('input-absensi');
            Route::get('absensi/{jadwal}', [AbsensiController::class, 'index'])->name('index');
            // Route::get('absensi/{siswa}/{jadwal}/tambah', [AbsensiController::class, 'tambah'])->name('tambah');
            Route::post('absensi/{jadwal}', [AbsensiController::class, 'simpan'])->name('simpan');
            // Route::get('absensi/{id_jadwal}/{absensi}/edit', [AbsensiController::class, 'edit'])->name('edit');
            // Route::put('absensi/{id_jadwal}/{absensi}', [AbsensiController::class, 'update'])->name('update');
        });
        Route::get('{guru}', [GuruController::class, 'detail'])->name('detail');
    });

    Route::prefix('rapor')->name('rapor.')->group(function() {
        Route::get('', [RaporController::class, 'index'])->name('index');
        Route::get('{siswa}', [RaporController::class, 'detail'])->name('detail');
    });

    Route::prefix('kelas')->name('kelas.')->group(function() {
        Route::get('', [KelasController::class, 'index'])->name('index');
        Route::get('tambah', [KelasController::class, 'tambah'])->name('tambah');
        Route::post('', [KelasController::class, 'simpan'])->name('simpan');
        Route::get('{kelas}', [KelasController::class, 'detail'])->name('detail');
        Route::get('{kelas}/edit', [KelasController::class, 'edit'])->name('edit');
        Route::put('{kelas}', [KelasController::class, 'update'])->name('update');
        Route::delete('{kelas}', [KelasController::class, 'destroy'])->name('destroy');
        Route::put('{kelas}/keluarkan-siswa/{siswa}', [KelasController::class, 'keluarkanSiswaDariKelas'])->name('keluarkan-siswa-dari-kelas');
        Route::put('{kelas}/pilih-siswa', [KelasController::class, 'pilihSiswa'])->name('pilih-siswa');

        Route::name('jadwal.')->group(function() {
            Route::get('{kelas}/jadwal', [JadwalController::class, 'index'])->name('index');
            Route::get('{kelas}/jadwal/tambah', [JadwalController::class, 'tambah'])->name('tambah');
            Route::post('{kelas}/jadwal-umum', [JadwalController::class, 'simpanUmum'])->name('simpan-umum');
            Route::post('{kelas}/jadwal-kejuruan', [JadwalController::class, 'simpanKejuruan'])->name('simpan-kejuruan');
            // Route::get('{kelas}/{jadwal}/edit', [JadwalController::class, 'edit'])->name('edit');
            // Route::put('{kelas}/{jadwal}', [JadwalController::class, 'update'])->name('update');
            Route::delete('{kelas}/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('jurusan')->name('jurusan.')->group(function() {
        Route::get('', [JurusanController::class, 'index'])->name('index');
        Route::get('/tambah', [JurusanController::class, 'tambah'])->name('tambah');
        Route::post('', [JurusanController::class, 'simpan'])->name('simpan');
        Route::get('/{jurusan}/edit', [JurusanController::class, 'edit'])->name('edit');
        Route::put('{jurusan}', [JurusanController::class, 'update'])->name('update');
        Route::delete('{jurusan}', [JurusanController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('tahun-ajaran')->name('tahun-ajaran.')->group(function() {
        Route::get('', [TahunAjaranController::class, 'index'])->name('index');
        Route::get('/tambah', [TahunAjaranController::class, 'tambah'])->name('tambah');
        Route::post('', [TahunAjaranController::class, 'simpan'])->name('simpan');
        Route::get('/{tahun_ajaran}/edit', [TahunAjaranController::class, 'edit'])->name('edit');
        Route::put('{tahun_ajaran}', [TahunAjaranController::class, 'update'])->name('update');
        Route::delete('{tahun_ajaran}', [TahunAjaranController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('pengumuman')->name('pengumuman.')->group(function() {
        Route::get('', [PengumumanController::class, 'index'])->name('index');
        Route::get('/tambah', [PengumumanController::class, 'tambah'])->name('tambah');
        Route::post('', [PengumumanController::class, 'simpan'])->name('simpan');
        Route::get('/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('edit');
        Route::put('{pengumuman}', [PengumumanController::class, 'update'])->name('update');
        Route::delete('{pengumuman}', [PengumumanController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('mapel')->name('mapel.')->group(function() {
        Route::get('', [MapelController::class, 'index'])->name('index');
        Route::get('tambah', [MapelController::class, 'tambah'])->name('tambah');
        Route::post('', [MapelController::class, 'simpan'])->name('simpan');
        Route::get('{mapel}/edit', [MapelController::class, 'edit'])->name('edit');
        Route::put('{mapel}', [MapelController::class, 'update'])->name('update');
        Route::delete('{mapel}', [MapelController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tagihan')->name('tagihan.')->group(function() {
        Route::get('', [TagihanController::class, 'index'])->name('index');
        Route::get('kelas/{kelas}', [TagihanController::class, 'daftarSiswa'])->name('kelas.daftar-siswa');
        Route::get('siswa/{siswa}/edit', [TagihanController::class, 'edit'])->name('siswa.edit');
        Route::put('{siswa}', [TagihanController::class, 'update'])->name('update');
    });

    Route::prefix('visi-misi')->name('visi-misi.')->group(function() {
        Route::get('', [VisiMisiController::class, 'index'])->name('index');
        Route::get('tambah-misi', [VisiMisiController::class, 'tambahMisi'])->name('tambah-misi');
        Route::post('', [VisiMisiController::class, 'simpanMisi'])->name('simpan-misi');
        Route::get('edit', [VisiMisiController::class, 'edit'])->name('edit');
        Route::post('', [VisiMisiController::class, 'update'])->name('update');
        Route::delete('{misi}', [VisiMisiController::class, 'destroyMisi'])->name('destroy-misi');
    });

    Route::prefix('setting')->name('setting.')->group(function() {
        Route::get('', [SettingController::class, 'index'])->name('index');
        Route::get('{setting}/edit', [SettingController::class, 'edit'])->name('edit');
        Route::put('{setting}', [SettingController::class, 'update'])->name('update');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
