<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ViewEmailController;

use App\Livewire\Dashboard;
use App\Livewire\UploadEmail;
use App\Livewire\EmailTable;

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

Route::get('/', Dashboard::class)->name('home');

Route::get('/upload', UploadEmail::class);
Route::get('/emails', EmailTable::class);
Route::get('/emails/{email:id}', ViewEmailController::class);
