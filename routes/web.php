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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::middleware('auth')->group(function() {

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


    // OFFERS
    // Route::middleware('can:student')->group(function () {
        Route::get('/offer/{offer}/show', [OfferController::class, 'show'])->name('offer.show')->where('offer', '[0-9]+');
    // });

    Route::get('/private_message/list', [PrivateMessageController::class, 'list'])->name('private_message.list')->middleware(['auth']);
    Route::get('/offer/myoffers', [OfferController::class, 'myoffers'])->name('offer.myoffers')->where('offer', '[0-9]+')->middleware('can:create-offer-and-reply');

    Route::get('/offer/{offer}/edit', [OfferController::class, 'edit'])->name('offer.edit')->where('offer', '[0-9]+')->middleware('can:manage-offer,offer');
    Route::post('/offer/{offer}', [OfferController::class, 'update'])->name('offer.update')->where('offer', '[0-9]+')->middleware('can:manage-offer,offer');
    Route::get('/offer/{offer}/destroy', [OfferController::class, 'destroy'])->name('offer.destroy')->where('offer', '[0-9]+')->middleware('can:manage-offer,offer');

    Route::get('/dashboard', [OfferController::class, 'index'])->name('dashboard')->middleware(['auth']);

    Route::middleware('can:create-offer-and-reply')->group(function() {
        // OFFERS
        Route::get('/offer/create', [OfferController::class, 'create'])->name('offer.create');
        Route::post('/offer', [OfferController::class, 'store'])->name('offer.store');

        // REPLIES
        Route::post('/reply/{offer}', [ReplyController::class, 'store'])->name('reply.store');
        Route::delete('/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy');
        Route::get('/reply', [ReplyController::class, 'index'])->name('reply.index');
        Route::get('/reply/{reply}', [ReplyController::class, 'show'])->name('reply.show');
        Route::get('/myreplies', [ReplyController::class, 'myreplies'])->name('reply.myreplies');
        // Suppression de la route refuse
        Route::get('/reply/{reply}/{status}/update', [ReplyController::class, 'update'])->name('reply.update');
    });

    // Private messages accessible à tout le monde ? Ou seulement pour les étudiants ? Gate a mettre selon reponse
    Route::get('/offer/{offer}/private_message/create', [PrivateMessageController::class, 'create'])->name('private_message.create')->where('offer', '[0-9]+');
    Route::get('offer/{offer}/private_message/{user}', [PrivateMessageController::class, 'index'])->name('private_message.index')->where('offer', '[0-9]+')->where('user', '[0-9]+');
    Route::post('/offer/{offer}/private_message', [PrivateMessageController::class, 'store'])->name('private_message.store')->where('offer', '[0-9]+');
    Route::post('/offer/{offer}/private_message/response', [PrivateMessageController::class, 'response'])->name('private_message.response')->where('offer', '[0-9]+');

});

require __DIR__.'/auth.php';
