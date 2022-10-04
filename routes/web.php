<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::controller(StatisticsController::class)
    ->as('statistics-')
    ->prefix('statistics')
    ->group(function ()
    {
        Route::get('/statistics', 'index')->name('index');
        Route::post('/statistics/get', 'get')->name('get');
        Route::get('/statistics/show/{code}', 'show')
            ->name('show');
    });
Route::controller(LinkController::class)
    ->as('link-')
    ->prefix('link')
    ->group(function ()
    {
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{code}', 'show')->name('show');
    });
Route::get('/{code}', [LinkController::class, 'visit'])->name('link-visit');
Auth::routes();
