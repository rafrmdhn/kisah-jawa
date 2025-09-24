<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
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

    // public function send(Request $request)
    // {
    //     $data = $request->validate([
    //         'name'    => 'required|string|max:255',
    //         'email'   => 'required|email',
    //         'subject' => 'required|string|max:255',
    //         'message' => 'required|string',
    //     ]);

    //     Mail::send('emails.contact', $data, function($message) use ($data) {
    //         $message->to('admin@example.com') // ganti dengan email admin
    //                 ->subject($data['subject'])
    //                 ->replyTo($data['email'], $data['name']);
    //     });

    //     return back()->with('success', 'Pesan berhasil dikirim!');
    // }
}
