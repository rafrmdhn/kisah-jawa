<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil berita terbaru untuk slider top news
        $topNews = Article::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Ambil berita utama untuk main slider
        $mainNews = Article::with('category')
            ->latest()
            ->take(2)
            ->get();

        // Featured news
        $featuredNews = Article::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(5)
            ->get();

        // Ambil kategori (misalnya 4 kategori untuk ditampilkan di kanan)
        $categories = Category::withCount('articles')
            ->take(4)
            ->get();

        $popularLeft = Article::orderBy('views', 'desc')
                            ->take(3)
                            ->get();
        $popularRight = Article::orderBy('views', 'desc')
                            ->skip(3)
                            ->take(3)
                            ->get();

        $latestLeft = Article::with('category')
            ->orderBy('tanggal_posting', 'desc')
            ->take(3)
            ->get();

        $latestRight = Article::with('category')
            ->orderBy('tanggal_posting', 'desc')
            ->skip(3)
            ->take(3)
            ->get();

        return view('news.index', compact(
            'topNews',
            'mainNews',
            'featuredNews',
            'categories',
            'popularLeft',
            'popularRight',
            'latestLeft',
            'latestRight'
        ));
    }
}
