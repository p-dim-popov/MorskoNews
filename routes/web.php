<?php

use App\Http\Controllers;
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

Route::redirect('/', '/articles');
Route::redirect('/dashboard', '/')->name('dashboard');

Route::get('articles/search/{slug}', [Controllers\ArticleController::class, 'search'])
    ->name('articles.search');
Route::resource('articles', Controllers\ArticleController::class);

require __DIR__.'/auth.php';
