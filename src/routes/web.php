<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin_it'])->group(function () {
     Route::resource('companies', CompanyController::class)->except(['show']);
});


Route::middleware(['auth', 'role:hrd,admin_hrd'])->group(function () {
    Route::resource('departments', DepartmentController::class)->except(['show']);
    Route::resource('positions', PositionController::class)->except(['show']);
    Route::resource('employees', EmployeeController::class)->except(['show']);
    Route::get('/employees/export', [\App\Http\Controllers\EmployeeController::class, 'export'])->name('employees.export');
    



});

Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/leaves', [\App\Http\Controllers\LeaveController::class, 'index'])->name('leaves.index');
    Route::patch('/leaves/{leave}/approve', [\App\Http\Controllers\LeaveController::class, 'approve'])->name('leaves.approve');
    Route::patch('/leaves/{leave}/reject', [\App\Http\Controllers\LeaveController::class, 'reject'])->name('leaves.reject');
});


Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/absensi', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('absensi.index');
    Route::post('/absensi', [\App\Http\Controllers\AttendanceController::class, 'store'])->name('absensi.store');
});

});

require __DIR__.'/auth.php';