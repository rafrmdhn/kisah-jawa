<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class TrendingController extends Controller
{
    public function index(Request $request)
    {
         $allowedCategories = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];

        $articles = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->whereDate('tanggal_posting', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->paginate(10);

        $trendingNews = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->whereDate('tanggal_posting', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->take(5)->get();

        $categories = Category::withCount('articles')
            ->whereIn('name', $allowedCategories)
            ->take(5)->get();

        $tags = Tag::latest()->take(20)->get();

        return view('trending.index', compact(
            'articles',
            'trendingNews',
            'categories',
            'tags'
        ));
    }
}
