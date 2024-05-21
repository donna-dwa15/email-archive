<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmailController;

// API Endpoint to allow a user to POST a .eml file and optional tags
Route::post('/upload', [EmailController::class, 'store']);