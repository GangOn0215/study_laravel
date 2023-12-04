<?php

use App\Http\Controllers\BoardsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Client\Request;
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
    return view('index');
});

Route::resource('todos', \App\Http\Controllers\TodosController::class);

Route::resource('boards', BoardsController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'study'], function () {
    Route::get('a01_default', );

    Route::post('a01_default', function(Request $request) {});

    Route::put('a01_default', function() {});

    Route::patch('a01_default', function() {});

    Route::delete('a01_default', function () {});

    Route::get('a02', function () {});
});

require __DIR__.'/auth.php';
