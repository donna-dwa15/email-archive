<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ViewEmailController;
use App\Http\Controllers\EmailController;

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

Route::view('/', 'index')->name('home');
Route::view('/index', 'index');
Route::view('/upload', 'index', ['header_text' => "Email Uploader", 'content_component' => "upload"]);

Route::get('/emails', EmailTable::class);
//Route::get('/emails', EmailController::class);
Route::get('/emails/{email:id}', ViewEmailController::class);
