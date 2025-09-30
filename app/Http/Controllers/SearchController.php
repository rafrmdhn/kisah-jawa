<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q     = trim($request->query('q', ''));
        $cat   = $request->query('cat');
        $sort  = $request->query('sort', 'recent');
        $days  = (int) $request->query('days', 0);
        $allowed = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];

        $categories = Category::select('name','slug')->orderBy('name')->get();

        $articles = Article::with('category')
            ->when($q !== '', function($query) use ($q) {
                $query->where(function($qq) use ($q) {
                    $qq->where('judul', 'like', "%{$q}%");
                });
            })
            ->whereHas('category', fn($c) => $c->whereIn('name', $allowed))
            ->orderBy('tanggal_posting','desc')
            ->paginate(12)
            ->appends($request->query());
        $trendingNews = Article::with('category')->trending(5, 7)->get();
        $tags = Tag::all();
        return view('search.index', compact(
            'articles',
            'q',
            'cat',
            'sort',
            'days',
            'categories',
            'trendingNews',
            'tags'
        ));
    }
}
