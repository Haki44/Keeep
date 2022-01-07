<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReferentController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PrivateMessageController;
use App\Http\Controllers\ReplyController;

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

// REFERENTS
Route::middleware('can:admin')->group(function () {
    Route::get('/referents/create', [ReferentController::class, 'create'])->name('referent.create');
    Route::post('/referents', [ReferentController::class, 'store'])->name('referent.store');
});

// STUDENTS
Route::middleware('can:handle-student')->group(function () {
    Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/students', [StudentController::class, 'store'])->name('student.store');
});

Route::get('/', function () {
    return view('welcome');
});

// OFFERS
// Route::middleware('can:student')->group(function () {
    Route::get('/offer/create', [OfferController::class, 'create'])->name('offer.create')->middleware('can:create-offer');
    Route::post('/offer', [OfferController::class, 'store'])->name('offer.store')->middleware('can:create-offer');

    Route::get('/offer/{offer}/show', [OfferController::class, 'show'])->name('offer.show')->where('offer', '[0-9]+');

    // Private messages
    Route::get('/offer/{offer}/private_message/create', [PrivateMessageController::class, 'create'])->name('private_message.create')->where('offer', '[0-9]+');
    Route::post('/offer/{offer}/private_message', [PrivateMessageController::class, 'store'])->name('private_message.store')->where('offer', '[0-9]+');
// });

Route::get('/offer/{offer}/edit', [OfferController::class, 'edit'])->name('offer.edit')->where('offer', '[0-9]+')->middleware('can:manage-offer,offer');
Route::post('/offer/{offer}', [OfferController::class, 'update'])->name('offer.update')->where('offer', '[0-9]+')->middleware('can:manage-offer,offer');
Route::get('/offer/{offer}/destroy', [OfferController::class, 'destroy'])->name('offer.destroy')->where('offer', '[0-9]+')->middleware('can:manage-offer,offer');

Route::get('/dashboard', [OfferController::class, 'index'])->name('dashboard')->middleware(['auth']);
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// REPLIES

Route::post('/reply/{offer}', [ReplyController::class, 'store'])->name('reply.store');
Route::delete('/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy');

require __DIR__.'/auth.php';
