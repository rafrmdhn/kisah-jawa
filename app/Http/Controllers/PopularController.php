<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function index(){
        $allowedCategories = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];

        $articles = Article::with('category')->popular()->paginate(10);

        $trendingNews = Article::with('category')->trending(5, 7)->get();

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
