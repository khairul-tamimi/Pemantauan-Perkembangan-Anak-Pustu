<?php

use App\Livewire\Konsultasi\Chat;
use App\Livewire\Konsultasi\Create;
use App\Livewire\Konsultasi\Edit;
use App\Livewire\Konsultasi\Index;
use App\Livewire\OrangTua\TindakLanjutChat;
use App\Livewire\Pustu\Anak\AnakCreate;
use App\Livewire\Pustu\Anak\AnakEdit;
use App\Livewire\Pustu\Anak\AnakIndex;
use App\Livewire\Pustu\Home\HomeIndex;
use App\Livewire\Pustu\JadwalKunjungan\JadwalKunjunganCreate;
use App\Livewire\Pustu\JadwalKunjungan\JadwalKunjunganEdit;
use App\Livewire\Pustu\JadwalKunjungan\JadwalKunjunganIndex;
use App\Livewire\Pustu\Pemeriksaan\PemeriksaanCreate;
use App\Livewire\Pustu\Pemeriksaan\PemeriksaanEdit;
use App\Livewire\Pustu\Pemeriksaan\PemeriksaanIndex;
use App\Livewire\Pustu\Pemeriksaan\PemeriksaanShow;
use App\Livewire\Pustu\RiwayatPosyandu\PosyanduCreate;
use App\Livewire\Pustu\RiwayatPosyandu\PosyanduEdit;
use App\Livewire\Pustu\RiwayatPosyandu\PosyanduIndex;
use App\Livewire\Pustu\StandarPertumbuhan\SpCreate;
use App\Livewire\Pustu\StandarPertumbuhan\SpEdit;
use App\Livewire\Pustu\StandarPertumbuhan\SpIndex;
use App\Livewire\Pustu\TindakLanjut\TindakLanjutCreate;
use App\Livewire\Pustu\TindakLanjut\TindakLanjutEdit;
use App\Livewire\User\UserCreate;
use App\Livewire\User\UserEdit;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));


Auth::routes();

Route::get('/home', HomeIndex::class)->name('home')->middleware('role:admin,petugas,orang_tua');

Route::get('/users', UserIndex::class)->name('users.index')->middleware('role:admin,petugas');
Route::get('/users/create', UserCreate::class)->name('users.create')->middleware('role:admin');
Route::get('/users/{id}/edit', UserEdit::class)->name('users.edit')->middleware('role:admin,petugas');

Route::get('/anak', AnakIndex::class)->name('anak.index')->middleware('role:admin,petugas,orang_tua');
Route::get('/anak/create', AnakCreate::class)->name('anak.create')->middleware('role:admin,petugas');
Route::get('/anak/{id}/edit', AnakEdit::class)->name('anak.edit')->middleware('role:admin,petugas,orang_tua');

Route::get('/posyandu/{anak_id}', PosyanduIndex::class)->name('posyandu.index')->middleware('role:admin,petugas,orang_tua');
Route::get('/posyandu/{anak_id}/create', PosyanduCreate::class)->name('posyandu.create')->middleware('role:admin,petugas');
Route::get('/posyandu/edit/{riwayat_id}', PosyanduEdit::class)->name('posyandu.edit')->middleware('role:admin,petugas');

Route::get('/pemeriksaan', PemeriksaanIndex::class)->name('pemeriksaan.index')->middleware('role:admin,petugas,orang_tua');
Route::get('/pemeriksaan/create', PemeriksaanCreate::class)->name('pemeriksaan.create')->middleware('role:admin,petugas');
Route::get('/pemeriksaan/{id}/edit', PemeriksaanEdit::class)->name('pemeriksaan.edit')->middleware('role:admin,petugas');
Route::get('/pemeriksaan/{id}', PemeriksaanShow::class)->name('pemeriksaan.show')->middleware('role:admin,petugas,orang_tua');

Route::get('/tindak-lanjut/create/{pemeriksaan_id}', TindakLanjutCreate::class)->name('tindak-lanjut.create')->middleware('role:admin,petugas');
Route::get('/tindak-lanjut/{id}/edit', TindakLanjutEdit::class)->name('tindak-lanjut.edit')->middleware('role:admin,petugas');

Route::get('/pustu/grafik', \App\Livewire\Pustu\Grafix\GrafixIndex::class)
    ->name('pustu.grafik')->middleware('role:admin,petugas,orang_tua');

Route::get('/standar-pertumbuhan', SpIndex::class)->name('standar-pertumbuhan.index')->middleware('role:admin,petugas');
Route::get('/standar-pertumbuhan/create', SpCreate::class)->name('standar-pertumbuhan.create')->middleware('role:admin,petugas');
Route::get('/standar-pertumbuhan/edit/{id}', SpEdit::class)->name('standar-pertumbuhan.edit')->middleware('role:admin,petugas');


Route::get('/notifikasi', TindakLanjutChat::class)->name('orangtua.tindak-lanjut')->middleware('role:orang_tua');

Route::get('/konsultasi', Index::class)->name('konsultasi.index')->middleware('role:admin,petugas,orang_tua');
Route::get('/konsultasi/create', Create::class)->name('konsultasi.create')->middleware('role:orang_tua');
Route::get('/konsultasi/{id}/edit', Edit::class)->name('konsultasi.edit')->middleware('role:orang_tua');
Route::get('/konsultasi/{id}/chat', Chat::class)->name('konsultasi.chat')->middleware('role:admin,petugas,orang_tua');

Route::get('/jadwal', JadwalKunjunganIndex::class)->name('jadwal-kunjungan.index');
Route::get('/jadwal/create', JadwalKunjunganCreate::class)->name('jadwal-kunjungan.create');
Route::get('/jadwal/{id}/edit', JadwalKunjunganEdit::class)->name('jadwal-kunjungan.edit');



// Route::middleware(['role:admin|petugas'])->group(function () {

// });

// Route::middleware(['role:petugas'])->group(function () {
// });

// Route::middleware(['role:orang_tua'])->group(function () {
// });
