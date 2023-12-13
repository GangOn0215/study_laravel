<?php

use App\Http\Controllers\BoardsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodosController;
use App\Models\LogStatistics;
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
    $data = array(
        'ip' => $_SERVER['REMOTE_ADDR'],
        'request_uri' => $_SERVER['REQUEST_URI'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        'http_referer' => @$_SERVER['HTTP_REFERER'],
    );

    LogStatistics::create($data);

    return view('index');
});

Route::get('/project', function() {
    return view('project/index');
});

Route::resource('todos', TodosController::class)->middleware('auth');

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
    Route::get('a01_default');

    Route::post('a01_default', function(Request $request) {});

    Route::put('a01_default', function() {});

    Route::patch('a01_default', function() {});

    Route::delete('a01_default', function () {});

    Route::get('a02', function () {});
});

require __DIR__.'/auth.php';
