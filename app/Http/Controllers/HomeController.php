<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
        $cardNames = ['Kriminal','Misteri','Film & Review','Opini'];

        $cardCats = Category::select('id','name','slug')
            ->whereIn('name', $cardNames)
            ->get()
            ->keyBy('name');

        $catImages = [
            'kriminal'     => 'https://images.hukumonline.com/frontend/lt649d88d229c26/lt649d896cc6261.jpg',
            'misteri'      => 'https://cdnpro.eraspace.com/media/mageplaza/blog/post/1/9/1931222270_1.jpg',
            'film-review'  => 'https://www.nyfa.edu/wp-content/uploads/2017/06/howtowriteafilmreview.png',
            'opini'        => 'https://asani.co.id/wp-content/uploads/2024/02/jenis-opini-audit.webp',
        ];

        $categoryCards = collect($cardNames)->map(function ($name) use ($cardCats, $catImages) {
            $slug = optional($cardCats->get($name))->slug ?? Str::slug($name);
            $img  = $catImages[$slug] ?? '/img/placeholder.jpg';
            return ['name' => $name, 'slug' => $slug, 'img' => $img];
        });

        $tags = Tag::all();

        $topNews = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->terbit()
            ->orderBy('tanggal_posting','desc')
            ->take(5)
            ->get();
        $mainNews = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->terbit()
            ->orderBy('tanggal_posting','desc')
            ->take(2)
            ->get();
        $featuredNews = Article::with('category')
            ->where('is_featured', true)
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->terbit()
            ->orderBy('tanggal_posting','desc')
            ->take(5)
            ->get();
        $categories = Category::withCount('articles')
            ->whereIn('name', ['Kriminal', 'Misteri', 'Opini', 'Film & Review', 'Sejarah'])
            ->take(5)
            ->get();
        $popularLeft = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->terbit()
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();
        $popularRight = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->terbit()
            ->orderBy('views', 'desc')
            ->skip(3)
            ->take(3)
            ->get();
        $latestLeft = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->terbit()
            ->orderBy('tanggal_posting', 'desc')
            ->take(3)
            ->get();
        $latestRight = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->whereIn('name', [
                    'Kriminal',
                    'Misteri',
                    'Film & Review',
                    'Opini',
                    'Sejarah',
                ]);
            })
            ->terbit()
            ->orderBy('tanggal_posting', 'desc')
            ->skip(3)
            ->take(3)
            ->get();
        $trendingNews = Article::with('category')
            ->terbit()
            ->trending(5, 7)
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
            'tags',
            'trendingNews',
            'categoryCards',
            'headerAd',
            'sidebarAd'
        ));
    }
}
