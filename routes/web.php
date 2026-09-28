<?php

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
	// El home visual del cliente es la página inicial de los módulos.
	return view('home');
})->name('home');

// El formulario de acceso se sirve con GET; JavaScript valida las credenciales contra el API.
Route::get('/login', function () {
	return view('Auth.login');
})->name('login');

// Estas rutas solo renderizan las vistas estáticas de Computers.
Route::get('/computers', function () {
	return view('Computer.index');
})->name('computers.index');

Route::get('/computers/create', function () {
	return view('Computer.create');
})->name('computers.create');

Route::get('/computers/{computer}/edit', function (string $computer) {
	return view('Computer.edit');
})->name('computers.edit');

Route::get('/computers/{computer}', function (string $computer) {
	return view('Computer.show');
})->name('computers.show');

Route::get('/apprentices', function () {
	return view('Apprentice.index', [
		'title' => 'Aprendices',
		'description' => 'Vista previa del registro de aprendices.',
		'columns' => ['Nombre', 'Correo', 'Celular'],
		'rows' => [['Aprendiz de muestra', 'aprendiz.demo@example.test', '000 000 0000']],
	]);
})->name('apprentices.index');

Route::get('/areas', function () {
	return view('Area.index', [
		'title' => 'Áreas',
		'description' => 'Vista previa de las áreas de formación.',
		'columns' => ['Nombre'],
		'rows' => [['Área de muestra']],
	]);
})->name('areas.index');

Route::get('/courses', function () {
	return view('Course.index', [
		'title' => 'Cursos',
		'description' => 'Vista previa de la oferta de cursos.',
		'columns' => ['Programa', 'Día'],
		'rows' => [['Programa de muestra', 'Lunes']],
	]);
})->name('courses.index');

Route::get('/course-teachers', function () {
	return view('CourseTeacher.index', [
		'title' => 'Asignaciones curso-instructor',
		'description' => 'Vista previa de las asignaciones académicas.',
		'columns' => ['Curso', 'Instructor'],
		'rows' => [['Curso de muestra', 'Instructor de muestra']],
	]);
})->name('course-teachers.index');

Route::get('/teachers', function () {
	return view('Teacher.index', [
		'title' => 'Instructores',
		'description' => 'Vista previa del directorio de instructores.',
		'columns' => ['Nombre', 'Correo'],
		'rows' => [['Instructor de muestra', 'instructor.demo@example.test']],
	]);
})->name('teachers.index');

Route::get('/training-centers', function () {
	return view('TrainingCenter.index', [
		'title' => 'Centros de formación',
		'description' => 'Vista previa de los centros de formación.',
		'columns' => ['Nombre', 'Ubicación'],
		'rows' => [['Centro de muestra', 'Regional Cauca']],
	]);
})->name('training-centers.index');

// Los nombres de ruta en inglés reemplazan las carpetas fuente en español.
Route::get('/calls', function () {
	return view('Calls.index');
})->name('calls.index');

Route::get('/offers', function () {
	return view('Offers.index');
})->name('offers.index');

Route::get('/history', function () {
	return view('History.index');
})->name('history.index');


