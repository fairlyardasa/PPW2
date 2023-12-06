<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/detail-buku/{id}', [BukuController::class, 'galbuku'])->name('galeri.buku');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/detail-buku/{id}', [BukuController::class, 'galbuku'])->name('galeri.buku');
    Route::post('/detail-buku/{id}', [BukuController::class, 'storeRating'])->name('rating.store');

    // Bikin error
    Route::post('/buku/myfavorite', [BukuController::class, 'storeFavorite'])->name('myfavorite.store');
    Route::get('/buku/myfavorite', [BukuController::class, 'myfavorite'])->name('myfavorite.buku');


    Route::middleware('admin')->group(function () {
        Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
        Route::resource('buku', BukuController::class)->except(['show', 'index']);
        Route::post('buku/delete_galeri/{id}', [BukuController::class, 'deleteGaleri'])->name('buku.delete_galeri');
    });
});


require __DIR__ . '/auth.php';