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
        $range = (int) $request->query('range', 7);
        $range = in_array($range, [1,7,30]) ? $range : 7;

        $allowedCategories = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];

        $articles = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->trending($range)
            ->latest('views')
            ->paginate(10)
            ->appends(['range' => $range]);

        $trendingNews = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->trending(7)->take(5)->get();

        $categories = Category::withCount('articles')
            ->whereIn('name', $allowedCategories)
            ->take(5)->get();

        $tags = Tag::query()->latest()->take(20)->get();

        return view('trending.index', compact(
            'articles', 'range', 'trendingNews', 'categories', 'tags'
        ));
    }
}
