<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $trendingNews = Article::with('category')->trending(5, 7)->get();
        $categories = Category::withCount('articles')
            ->whereIn('name', ['Kriminal', 'Misteri', 'Opini', 'Film & Review', 'Sejarah'])
            ->take(5)
            ->get();
        $tags = Tag::all();
        return view('contact.index', compact(
            'trendingNews',
            'categories',
            'tags'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:190',
            'subject' => 'required|string|max:190',
            'message' => 'required|string',
        ]);

        $data['ip']         = $request->ip();
        $data['user_agent'] = $request->userAgent();

        Contact::create($data);

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih!');
    }
}
