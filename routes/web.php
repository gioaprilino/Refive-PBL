<?php

use App\Livewire\ProjectDetail;
use App\Livewire\ShowHome;
use App\Livewire\ShowService;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', ShowHome::class)->name('home');
Route::get('/service-details/{id}', ShowService::class)->name('servicePage');
Route::get('/project-details/{id}', ProjectDetail::class)->name('projectPage');
