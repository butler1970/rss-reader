<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\RssFeedController;
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

Route::get('/', [RssFeedController::class, 'new']);
Route::post('/', [RssFeedController::class, 'add'])->name('rss-feed.update');
Route::get('/feeds', [RssFeedController::class, 'feeds']);
Route::get('/pdf', [PdfController::class, 'renderAsPdf']);
