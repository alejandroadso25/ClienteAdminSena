<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;
use Illuminate\Support\Facades\Route;

// Página pública de inicio; solo renderiza la vista Blade.
Route::view('/', 'welcome')->name('home');

// Aprendices: GET muestra el listado o formulario; POST envía la creación al API central.
Route::get('apprentices', [ApprenticeController::class, 'index'])->name('apprentices.index');
Route::get('apprentices/create', [ApprenticeController::class, 'create'])->name('apprentices.create');
Route::post('apprentices', [ApprenticeController::class, 'store'])->name('apprentices.store');

// Áreas: GET muestra el listado o formulario; POST crea el registro en el API central.
Route::get('areas', [AreaController::class, 'index'])->name('areas.index');
Route::get('areas/create', [AreaController::class, 'create'])->name('areas.create');
Route::post('areas', [AreaController::class, 'store'])->name('areas.store');

// Computadores: GET muestra el listado o formulario; POST crea el registro en el API central.
Route::get('computers', [ComputerController::class, 'index'])->name('computers.index');
Route::get('computers/create', [ComputerController::class, 'create'])->name('computers.create');
Route::post('computers', [ComputerController::class, 'store'])->name('computers.store');

// Cursos: GET muestra el listado o formulario; POST crea el registro en el API central.
Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('courses', [CourseController::class, 'store'])->name('courses.store');

// Asignaciones: GET muestra el listado o formulario; POST crea la relación en el API central.
Route::get('course-teachers', [CourseTeacherController::class, 'index'])->name('course-teachers.index');
Route::get('course-teachers/create', [CourseTeacherController::class, 'create'])->name('course-teachers.create');
Route::post('course-teachers', [CourseTeacherController::class, 'store'])->name('course-teachers.store');

// Instructores: GET muestra el listado o formulario; POST crea el registro en el API central.
Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
Route::post('teachers', [TeacherController::class, 'store'])->name('teachers.store');

// Centros de formación: GET muestra el listado o formulario; POST crea el registro en el API central.
Route::get('training-centers', [TrainingCenterController::class, 'index'])->name('training-centers.index');
Route::get('training-centers/create', [TrainingCenterController::class, 'create'])->name('training-centers.create');
Route::post('training-centers', [TrainingCenterController::class, 'store'])->name('training-centers.store');

// Secciones informativas estáticas que no consultan ni modifican recursos del API.
Route::view('calls', 'Calls.index')->name('calls.index');
Route::view('offers', 'Offers.index')->name('offers.index');
Route::view('history', 'History Sena.index')->name('history.index');
