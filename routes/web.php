<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

//contoh route dasar
Route::get('/', function () {
    return view('welcome');
});

//route untuk halaman about
Route::get('/about', function () {
    return 'Halaman About';
});

//contoh route dengan parameter
Route::get('/user/{name}', function ($name) {
    return 'Halo, ' . $name;
});

//contoh route dengan lempar data ke view
Route::get('/profile', function () {
    $data = [
        'name' => 'Denny Chandra',
        'age' => 25,
    ];
    //return view('profile', $data);//nama saya {{ $name }} umur saya {{ $age }} tahun.
    //return view('profile')->with($data);//nama saya {{ $name }} umur saya {{ $age }} tahun.
    //compact
    return view('profile', compact('data'));//nama saya {{ $data['name'] }} umur saya {{ $data['age'] }} tahun.
});

//route untuk halaman contact menggunakan controller
Route::get('/contact', [ContactController::class, 'index']);

Route::resource('categories', CategoryController::class); //MEMBUAT ALAMAT SESUAI PERUNTUKANNYA, RESOURCE CARA SINGKAT MEMBUAT CRUD
Route::resource('books', BookController::class);