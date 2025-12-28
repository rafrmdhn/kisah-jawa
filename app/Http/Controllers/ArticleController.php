<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::with('category','tags')
            ->terbit()
            ->latest()
            ->paginate(10);
        return view('news.index', compact('articles'));
    }

    public function show($slug, Request $request)
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
        $article = Article::with(['category','tags', 'additional_authors'])
            ->where('slug',$slug)
            ->terbit()
            ->firstOrFail();

        $sessKey = "viewed_article_{$article->id}";
        if (! $request->session()->has($sessKey)) {
            \App\Models\Article::whereKey($article->id)->increment('views');
            $request->session()->put($sessKey, now());
        }

        $trendingNews = Article::with('category')
            ->trending(5, 7)
            ->terbit()
            ->get();
        $categories = Category::withCount('articles')
            ->whereIn('name', [
                'Kriminal',
                'Misteri',
                'Opini',
                'Film & Review',
                'Sejarah'
            ])
            ->take(5)
            ->get();
        $tags = Tag::latest()->take(20)->get();

        return view('news.show', compact(
            'article',
            'trendingNews',
            'categories',
            'tags',
            'headerAd',
            'sidebarAd'
        ));
    }

    public function comment(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:artikels,id',
            'parent_id'  => 'nullable|exists:comments,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'website'    => 'nullable|url|max:255',
            'message'    => 'required|string',
        ]);

        $emailHash = md5(strtolower(trim($validated['email'])));
        $validated['avatar'] = "https://www.gravatar.com/avatar/{$emailHash}?s=80&d=mp";

        Comment::create($validated);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function search(Request $request)
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
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
            ->terbit()
            ->orderBy('tanggal_posting','desc')
            ->paginate(12)
            ->appends($request->query());
        $trendingNews = Article::with('category')
            ->trending(5, 7)
            ->terbit()
            ->get();
        $tags = Tag::latest()->take(20)->get();
        return view('news.search', compact(
            'articles',
            'q',
            'cat',
            'sort',
            'days',
            'categories',
            'trendingNews',
            'tags',
            'headerAd',
            'sidebarAd'
        ));
    }

    public function popular(){
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
        $allowedCategories = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];

        $articles = Article::with('category')
            ->orderBy('tanggal_posting','desc')
            ->popular()
            ->paginate(10);

        $trendingNews = Article::with('category')
            ->trending(5, 7)
            ->get();

        $categories = Category::withCount('articles')
            ->whereIn('name', $allowedCategories)
            ->take(5)->get();

        $tags = Tag::latest()->take(20)->get();

        return view('news.popular', compact(
            'articles',
            'trendingNews',
            'categories',
            'tags',
            'headerAd',
            'sidebarAd'
        ));
    }

    public function trending(Request $request)
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
        $allowedCategories = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];

        $articles = Article::with('category')->trending(7)->paginate(10);

        $trendingNews = Article::with('category')->trending(5, 7)->get();

        $categories = Category::withCount('articles')
            ->whereIn('name', $allowedCategories)
            ->take(5)->get();

        $tags = Tag::latest()->take(20)->get();

        return view('news.trending', compact(
            'articles',
            'trendingNews',
            'categories',
            'tags',
            'headerAd',
            'sidebarAd'
        ));
    }

    public function newest(Request $request)
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
        $allowed = ['Kriminal','Misteri','Film & Review','Opini','Sejarah'];

        $cat = $request->query('cat');

        $articles = Article::with('category')
            ->when($cat, fn($q) => $q->whereHas('category', fn($c) => $c->where('slug', $cat)))
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowed))
            ->newest()
            ->paginate(12)
            ->appends($request->query());

        $trendingNews = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowed))
            ->whereDate('tanggal_posting','>=', now()->subDays(7))
            ->orderBy('views','desc')->take(5)->get();

        $categories = Category::withCount('articles')
            ->whereIn('name', $allowed)->take(5)->get();

        $tags = Tag::query()->latest()->take(20)->get();

        return view('news.newest', compact('articles','trendingNews','categories','tags','cat', 'sidebarAd','headerAd'));
    }
}
