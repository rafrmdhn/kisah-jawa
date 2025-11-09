<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $activeSlug = $request->query('cat');
        $allowedNames = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];
        $categories = Category::whereIn('name', $allowedNames)
            ->take(5)
            ->get();

        $query =  Article::with('category')
            ->whereHas('category', function ($q) use ($allowedNames) {
                $q->whereIn('name', $allowedNames);
            })
            ->terbit()
            ->orderBy('tanggal_posting','desc');

        $activeCategory = null;
        if ($activeSlug) {
            $activeCategory = Category::where('slug', $activeSlug)->firstOrFail();
            $query->where('category_id', $activeCategory->id);
        }

        $articles = $query->paginate(10)->appends(['cat' => $activeSlug]);


        $trendingNews = Article::with('category')
            ->terbit()
            ->trending(5, 7)
            ->get();

        $sidebarCategories = Category::withCount('articles')
            ->whereIn('name', $allowedNames)
            ->take(5)
            ->get();

        $tags = Tag::all();

        return view('categories.index', compact(
            'categories',
            'activeCategory',
            'activeSlug',
            'articles',
            'trendingNews',
            'sidebarCategories',
            'tags'
        ));
    }
}
