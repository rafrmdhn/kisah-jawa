<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PopularController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:1,1');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/comments/store', [ArticleController::class, 'comment'])->name('comments.store');
Route::get('/trending', [ArticleController::class, 'trending'])->name('trending.index');
Route::get('/tags/{tag:slug}', [TagController::class, 'show'])->name('tags.show');
Route::get('/search', [ArticleController::class, 'search'])->name('search.index');
Route::get('/populer', [ArticleController::class, 'popular'])->name('popular.index');
Route::get('/newest', [ArticleController::class, 'newest'])->name('newest.index');

