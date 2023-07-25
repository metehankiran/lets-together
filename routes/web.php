<?php

use App\Events\NewDot;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\MessageController;
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

Auth::routes();

Route::get('/board/{board:slug}', [BoardController::class, 'index'])->name('board');
Route::post('/board/{board:slug}/dot', [BoardController::class, 'addDot'])->name('dot.store');
Route::get('test', function () {
    $data = [
        'x' => 14,
        'y' => 13,
        'color' => '#e5e5e5'
    ];

    event(new NewDot($data));
    return "painting";
});
