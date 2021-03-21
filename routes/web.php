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

Route::resource('articles', Controllers\ArticleController::class);

require __DIR__.'/auth.php';
