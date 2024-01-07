<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapsMarkerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/Maps', [MapsMarkerController::class, 'index'])->name('maps.index');
Route::get('/Maps/create', [MapsMarkerController::class, 'create'])->name('maps.create');
Route::post('/Maps', [MapsMarkerController::class, 'store'])->name('maps.store');
Route::get('/Maps/{id}/edit', [MapsMarkerController::class, 'edit'])->name('maps.edit');
Route::put('/Maps/{id}', [MapsMarkerController::class, 'update'])->name('maps.update');
Route::delete('/Maps/{id}', [MapsMarkerController::class, 'destroy'])->name('maps.destroy');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
