<?php

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
    return redirect('/el');
});

Route::get('/panel', function () {
    return redirect('/el/panel');
});

Route::get('/analytics', function () {
    return view('panel/analytics');
})->name('analytics');

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');;

    Route::get('/panel', function () {
        return view('panel/index');
    })->name('panel');
});

Route::get('/apis', function () {
    return view('panel/apis');
})->name('apis');
