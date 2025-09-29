<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $tags = Tag::all();
        $articles = Article::with('category','tags')
            ->whereHas('tags', fn($q) => $q->where('tags.id', $tag->id))
            ->latest()
            ->paginate(10);

        $allowed = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];
        $categories = Category::withCount('articles')
            ->whereIn('name', $allowed)->take(5)->get();

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
        return view('tags.show', compact(
            'tag',
            'articles',
            'categories',
            'trendingNews',
            'tags'
        ));
    }
}
