<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Naykel\Gotime\Facades\RouteBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::resource('projects', ProjectController::class)->only('index', 'show');

RouteBuilder::create('nav-main');


