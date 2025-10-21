<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'welcome'])->name('home');
Route::get('/authors/top', [BookController::class, 'topAuthors'])->name('authors.top');

Route::get('/ratings/create', [BookController::class, 'createRating'])->name('ratings.create');
Route::post('/ratings', [BookController::class, 'storeRating'])->name('ratings.store');

// AJAX: ambil buku berdasarkan author
Route::get('/authors/{author}/books', [BookController::class, 'booksByAuthor']);