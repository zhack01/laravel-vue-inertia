<?php

use App\Http\Controllers\GameController;
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

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    #Games
    Route::get('games/index', [GameController::class,'index'])->name('games-index');
    Route::get('games/add', [GameController::class,'store'])->name('games-add');
    Route::post('games/provider', [GameController::class,'provider'])->name('games-provider');
    Route::get('games/list', [GameController::class,'gameList'])->name('games-list');
    Route::get('games/game-type', [GameController::class,'gameType'])->name('game-type');
    Route::get('games/game', [GameController::class,'game'])->name('game');
    Route::post('games/update', [GameController::class,'update'])->name('update');
    Route::post('games/status', [GameController::class,'status'])->name('status');
});



require __DIR__.'/auth.php';
