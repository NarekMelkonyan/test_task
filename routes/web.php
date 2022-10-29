<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::post('/generate_url', [\App\Http\Controllers\LinkController::class, 'store'])
        ->name('generate_url');

    Route::post('/uploadLinks', [\App\Http\Controllers\LinkController::class, 'uploadLinks'])
        ->name('upload_links');

    Route::get('/short_link/{data}', [\App\Http\Controllers\LinkController::class, 'short_link'])
        ->name('short_link');

    Route::get('{data}', [\App\Http\Controllers\LinkController::class, 'pageLink'])
        ->name('page_link');

    Route::post('/download_file', [\App\Http\Controllers\LinkController::class, 'download_file'])
        ->name('download_file');
});

