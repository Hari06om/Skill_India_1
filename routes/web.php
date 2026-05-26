<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');
Route::view('/features', 'features')->name('features');
Route::view('/coaches', 'coaches')->name('coaches');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
