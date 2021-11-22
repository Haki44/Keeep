<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;

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

Route::get('/', function () {
    return view('welcome');
});

// OFFERS
// Route::middleware('can:student')->group(function () {
    Route::get('/offer/create', [OfferController::class, 'create'])->name('offer.create');
    Route::post('/offer', [OfferController::class, 'store'])->name('offer.store');
// });

Route::get('/dashboard', [OfferController::class, 'index'])->name('dashboard')->middleware(['auth']);
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
