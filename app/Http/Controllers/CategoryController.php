<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereIn('slug', ['kriminal', 'misteri', 'film-review', 'opini', 'sejarah'])
            ->withCount('articles')
            ->get();
        $trendingNews = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->whereDate('tanggal_posting', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        $tags = Tag::all();
        return view('categories.index', compact(
            'categories',
            'trendingNews',
            'tags'
        ));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = Article::with('category')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(10);
        $trendingNews = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->whereDate('tanggal_posting', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        $categories = Category::withCount('articles')
            ->whereIn('name', ['Kriminal', 'Misteri', 'Opini', 'Film & Review', 'Sejarah'])
            ->take(5)
            ->get();
        $tags = Tag::all();
        return view('categories.show', compact(
            'category',
            'articles',
            'trendingNews',
            'categories',
            'tags'
        ));
    }
}
