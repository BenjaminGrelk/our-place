<?php

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
    return view('login');
});

// Login page that takes the username and password from / route and displays the welcome view
Route::post('/login', function () {
    return view('welcome', [
        'username' => request('username'),
        'password' => request('password')
    ]);
})->name('login');

Route::get('users', function () {
    return 'Users cool!';
});
