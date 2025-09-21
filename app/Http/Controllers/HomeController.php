<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $topNews = Article::with('category')
            ->latest()
            ->take(5)
            ->get();
        $mainNews = Article::with('category')
            ->latest()
            ->take(2)
            ->get();
        $featuredNews = Article::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(5)
            ->get();
        $categories = Category::withCount('articles')
            ->whereIn('name', ['Kriminal', 'Misteri', 'Opini', 'Film & Review', 'Sejarah'])
            ->take(5)
            ->get();
        $popularLeft = Article::orderBy('views', 'desc')
                            ->take(3)
                            ->get();
        $popularRight = Article::orderBy('views', 'desc')
                            ->skip(3)
                            ->take(3)
                            ->get();
        $latestLeft = Article::with('category')
            ->orderBy('tanggal_posting', 'desc')
            ->take(3)
            ->get();
        $latestRight = Article::with('category')
            ->orderBy('tanggal_posting', 'desc')
            ->skip(3)
            ->take(3)
            ->get();
        return view('news.index', compact(
            'topNews',
            'mainNews',
            'featuredNews',
            'categories',
            'popularLeft',
            'popularRight',
            'latestLeft',
            'latestRight',
            'tags'
        ));
    }
}
