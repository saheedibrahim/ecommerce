<?php

use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('example-frontend');
// });

Route::controller(FrontEndController::class)->group(function(){
    Route::get('/', 'homePage')->name('home-page');
});

Route::view('/example-page', 'example-page');
Route::view('/example-auth', 'example-auth');
// Route::view('/example-frontend', 'example-frontend');
