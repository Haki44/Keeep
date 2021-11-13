<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferentController;
use App\Http\Controllers\StudentController;

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

// DOCUMENTATION
Route::get('/doc', function () {
    return view('documentation');
})->name('documentation');

// A ajouter un middleware/gate admin
Route::get('/referent/create', [ReferentController::class, 'create'])->name('referent.create');
Route::post('/referent', [ReferentController::class, 'store'])->name('referent.store');

Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
