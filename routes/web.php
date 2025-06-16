<?php

use App\Http\Controllers\CompanyAboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyStatisticController;
use App\Http\Controllers\OurPrincipleController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectClientController;
use App\Http\Controllers\TestimonialController;
use \App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HeroSectionController;
use App\Models\Appointment;
use App\Models\CompanyStatistic;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/team', [FrontController::class, 'team'])->name('front.team'); 
Route::get('/products', [FrontController::class, 'products'])->name('front.products');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/blog', [FrontController::class, 'blog'])->name('front.blog');
Route::get('/appointment',[FrontController::class, 'appointment'])->name('front.appointment');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware('can: manage statistics')->group(function () {
            Route::resource('statistics', CompanyStatisticController::class);
        });

         Route::middleware('can: manage products')->group(function () {
            Route::resource('products', ProductController::class);
        });

        Route::middleware('can: manage principles')->group(function () {
            Route::resource('principles', OurPrincipleController::class);
        });

        Route::middleware('can: manage testimonials')->group(function () {
            Route::resource('testimonials', TestimonialController::class);
        });

        Route::middleware('can:manage clients')->group(function (){
            Route::resource('clients', ProjectClientController::class);
        });

        Route::middleware('can: manage teams')->group(function () {
            Route::resource('teams', OurTeamController::class);
        });

        Route::middleware('can: manage abouts')->group(function () {
            Route::resource('abouts',CompanyAboutController::class);
        });

        Route::middleware('can:manage appointments')->group(function (){
            Route::resource('appointments', AppointmentController::class);
        });

        Route::middleware('can:manage hero sections')->group(function (){
            Route::resource('hero_sections', HeroSectionController::class);
        });

    });
});

require __DIR__.'/auth.php';
