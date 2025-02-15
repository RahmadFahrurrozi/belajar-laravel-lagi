<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [BlogController::class, 'indexBlog'])->name('blog');


// Route::get('/about', function () {
//     $profile = [
//         'name' => 'John Doe',
//         'email' => 'HcK8e@example.com',
//         'phone' => '123-456-7890',
//     ];
//     return view('about', ['profile' => $profile]);
// })->name('about');

// Route::get('/blog/{id}', function (Request $request) {
//     return 'Blog ID: ' . $request->id;
// })->name('blog');
