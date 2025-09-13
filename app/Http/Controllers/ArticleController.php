<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::with('category','author','tags')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function show($slug) {
        $article = Article::with(['category','author','tags','comments.replies'])->where('slug',$slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }
}
