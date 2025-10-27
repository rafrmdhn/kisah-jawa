<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\ContactFormSubmitted;
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
            'name'    => ['required','string','max:100'],
            'email'   => ['required','email','max:150'],
            'telp'    => ['required','string','max:12'],
            'subject' => ['required','string','max:150'],
            'message' => ['required','string','max:5000'],
        ]);

        $to = 'ramadhanrafi871@gmail.com';
        Mail::to($to)->send(new ContactFormSubmitted($data));

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih!');
    }
}
