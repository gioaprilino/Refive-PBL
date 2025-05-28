<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Department\Index as DepartmentIndex;
use App\Livewire\Department\Create as DepartmentCreate;
use App\Livewire\Department\Edit as DepartmentEdit;
use App\Livewire\Position\Index as PositionIndex;
use App\Livewire\Position\Create as PositionCreate;
use App\Livewire\Position\Edit as PositionEdit;
use App\Livewire\Employee\Index as EmployeeIndex;
use App\Livewire\Employee\Create as EmployeeCreate;
use App\Livewire\Employee\Edit as EmployeeEdit;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/departments', DepartmentIndex::class)->name('department.index');
Route::get('/departments/create', DepartmentCreate::class)->name('department.create');
Route::get('/departments/{id}/edit', DepartmentEdit::class)->name('department.edit');

Route::get('/positions', PositionIndex::class)->name('position.index');
Route::get('/positions/create', PositionCreate::class)->name('position.create');
Route::get('/positions/{id}/edit', PositionEdit::class)->name('position.edit');

Route::get('/employees', EmployeeIndex::class)->name('employee.index');
Route::get('/employees/create', EmployeeCreate::class)->name('employee.create');
Route::get('/employees/{id}/edit', EmployeeEdit::class)->name('employee.edit');
