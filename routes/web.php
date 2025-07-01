<?php

use App\Livewire\JobApplyPage;
use App\Livewire\JobPage;
use App\Livewire\NewsDetailPage;
use App\Livewire\NewsPage;
use App\Livewire\ProjectDetail;
use App\Livewire\ShowHome;
use App\Livewire\ShowService;
use App\Livewire\Presensi;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', ShowHome::class)->name('home');
Route::get('/service-details/{id}', ShowService::class)->name('servicePage');
Route::get('/project-details/{id}', ProjectDetail::class)->name('projectPage');
Route::get('/berita', NewsPage::class)->name('news.index');
Route::get('/berita/{news}', NewsDetailPage::class)->name('news.show');
Route::get('/lowongan', JobPage::class)->name('jobs.index');
Route::get('/lowongan/{job}/apply', JobApplyPage::class)->name('jobs.apply');

Route::group(['middleware' => 'auth'], function() {
    Route::get('presensi', Presensi::class)->name('presensi');
});
