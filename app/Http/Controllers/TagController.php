<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
        $tags = Tag::latest()->take(10)->get();
        $articles = Article::with('category','tags')
            ->whereHas('tags', fn($q) => $q->where('tags.id', $tag->id))
            ->terbit()
            ->orderBy('tanggal_posting','desc')
            ->paginate(10);

        $allowed = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];
        $categories = Category::withCount('articles')
            ->whereIn('name', $allowed)->take(5)->get();

        $trendingNews = Article::with('category')
            ->terbit()
            ->trending(5, 7)
            ->get();
        return view('tags.show', compact(
            'tag',
            'articles',
            'categories',
            'trendingNews',
            'tags',
            'headerAd',
            'sidebarAd'
        ));
    }
}
