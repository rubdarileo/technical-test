<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware'=>['auth', 'verified']],function(){
    Route::resource('/users', UserController::class);
    Route::get('/emails/{user}', [EmailController::class, 'index']);
    Route::get('/emails/create/{user}', [EmailController::class, 'create']);
    Route::post('/emails/{user}', [EmailController::class, 'store']);
    Route::delete('/emails/{email}', [EmailController::class, 'destroy']);
});

require __DIR__.'/auth.php';
