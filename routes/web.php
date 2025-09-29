<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\TagController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/comments/store', [ArticleController::class, 'comment'])->name('comments.store');
Route::get('/trending', [TrendingController::class, 'index'])->name('trending.index');
Route::get('/tags/{tag:slug}', [TagController::class, 'show'])->name('tags.show');

