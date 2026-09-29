<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	// La vista welcome contiene el inicio visual y los accesos a los módulos.
	return view('welcome');
})->name('home');

// El listado de computadores también se carga desde el controlador mediante GET.
Route::get('/computers', [ComputerController::class, 'index'])->name('computers.index');

Route::get('/computers/{computer}/edit', function (string $computer) {
	return view('Computer.edit');
})->whereNumber('computer')->name('computers.edit');

Route::get('/computers/{computer}', function (string $computer) {
	return view('Computer.show');
})->whereNumber('computer')->name('computers.show');

// Cada listado usa su controlador para consultar el endpoint correspondiente del API.
Route::get('/apprentices', [ApprenticeController::class, 'index'])->name('apprentices.index');
Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/course-teachers', [CourseTeacherController::class, 'index'])->name('course-teachers.index');
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/training-centers', [TrainingCenterController::class, 'index'])->name('training-centers.index');

// Los nombres de ruta en inglés reemplazan las carpetas fuente en español.
Route::get('/calls', function () {
	return view('Calls.index');
})->name('calls.index');

Route::get('/offers', function () {
	return view('Offers.index');
})->name('offers.index');

Route::get('/history', function () {
	return view('History Sena.index');
})->name('history.index');


