<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TimeblockController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
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
    return view('homepage');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/sendmail', [UserController::class, 'sendEmail'])->name('sendmail');


Route::middleware('auth', 'role:Eigenaar')->group(function () {
    Route::get('/afspraak', [ReservationController::class, 'index'])->name('appointment.index');
});

Route::get('/afspraak/aanmaken', [ReservationController::class, 'create'])->name('appointment.create');
Route::post('/afspraak/opslaan', [ReservationController::class, 'store'])->name('appointment.store');
Route::get('/afspraak/{appointment}/bewerken', [ReservationController::class, 'edit'])->name('appointment.edit');
Route::put('/afspraak/{appointment}', [ReservationController::class, 'update'])->name('appointment.update');
Route::put('/afspraak/{appointment}/annuleren', [ReservationController::class, 'cancel'])->name('appointment.cancel');

Route::get('/behandelingenLijst', [ReservationController::class, 'getTreatments'])->name('treatments.get');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role:Eigenaar')->group(function () {
    Route::get('/behandelingen', [TreatmentController::class, 'index'])->name('treatments.index');
    Route::get('/behandelingen/aanmaken', [TreatmentController::class, 'create'])->name('treatments.create');
    Route::post('/behandelingen/opslaan', [TreatmentController::class, 'store'])->name('treatments.store');
    Route::get('/behandelingen/{id}/aanpassen', [TreatmentController::class, 'edit'])->name('treatments.edit');
    Route::post('/behandelingen/{id}/verwijderen', [TreatmentController::class, 'delete'])->name('treatments.delete');
    Route::put('/behandelingen/{id}/update', [TreatmentController::class, 'update'])->name('treatments.update');
});

Route::middleware('auth', 'role:Eigenaar')->group(function () {
    Route::get('/gebruikers', [UserController::class, 'index'])->name('user.index');
    Route::get('/gebruikers/aanmaken', [UserController::class, 'create'])->name('user.create');
    Route::post('/gebruikers/opslaan', [UserController::class, 'store'])->name('user.store');
    Route::get('/gebruikers/{id}/aanpassen', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/gebruikers/{id}/verwijderen', [UserController::class, 'delete'])->name('user.delete');
    Route::put('/gebruikers/{id}/update', [UserController::class, 'update'])->name('user.update');
});

Route::middleware('auth', 'role:Eigenaar')->group(function () {
    Route::get('/timeblocks', [TimeblockController::class, 'index'])->name('timeblock.index');
    Route::get('/timeblocks/aanmaken', [TimeblockController::class, 'create'])->name('timeblock.create');
    Route::post('/timeblocks/opslaan', [TimeblockController::class, 'store'])->name('timeblock.store');
    Route::get('/timeblocks/{id}/aanpassen', [TimeblockController::class, 'edit'])->name('timeblock.edit');
    Route::post('/timeblocks/{id}/verwijderen', [TimeblockController::class, 'delete'])->name('timeblock.delete');
    Route::put('/timeblocks/{id}/update', [TimeblockController::class, 'update'])->name('timeblock.update');
});

require __DIR__ . '/auth.php';
