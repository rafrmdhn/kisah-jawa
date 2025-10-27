@extends('layouts.main')

@section('container')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="{{ url('/') }}">Beranda</a>
                <a class="breadcrumb-item" href="{{ route('category.index', ['cat' => $article->category->slug]) }}">{{ $article->category->name }}</a>
                <span class="breadcrumb-item active">{{ Str::limit($article->judul, 50) }}</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="{{ $article->sumber_gambar }}" style="object-fit: cover;">
                        <div class="overlay position-relative bg-light">
                            <div class="mb-3">
                                <a href="{{ route('category.index', ['cat' => $article->category->slug]) }}">{{ $article->category->name }}</a>
                                <span class="px-1">/</span>
                                <span>{{ \Carbon\Carbon::parse($article->tanggal_posting)->translatedFormat('l, d F Y') }}</span>
                            </div>
                            <div>
                                <h3 class="mb-3">{{ $article->judul }}</h3>
                                {!! $article->deskripsi !!}
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->

                    <!-- Comment List Start -->
                    <div class="bg-light mb-3 p-4">
                        <h3 class="mb-4">{{ $article->comments()->count() }} Comments</h3>

                        @foreach($article->comments->where('parent_id', null) as $comment)
                            <div class="media mb-4">
                                <img src="{{ $comment->avatar }}" alt="Avatar" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>{{ $comment->name }} <small><i>{{ $comment->created_at->diffForHumans() }}</i></small></h6>
                                    <p>{{ $comment->message }}</p>

                                    <button class="btn btn-sm btn-outline-secondary"
                                            onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block'">
                                        Reply
                                    </button>

                                    <div id="reply-form-{{ $comment->id }}" style="display:none; margin-top:15px;">
                                        <form action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Name *" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="Email *" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="Website" class="form-control" name="Website" placeholder="Website">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="message" rows="3" placeholder="Reply..." required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Submit Reply</button>
                                        </form>
                                    </div>

                                    <!-- Tampilkan reply -->
                                    @foreach($comment->replies as $reply)
                                        <div class="media mt-4">
                                            <img src="{{ $reply->avatar }}" alt="Avatar" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>{{ $reply->name }} <small><i>{{ $reply->created_at->diffForHumans() }}</i></small></h6>
                                                <p>{{ $reply->message }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <div class="bg-light mb-3" style="padding: 30px;">
                        <h3 class="mb-4">Leave a comment</h3>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="hidden" name="parent_id" id="parent_id" value="">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website" name="website">
                            </div>

                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" cols="30" rows="5" class="form-control" name="message" required></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" value="Leave a comment"
                                    class="btn btn-primary font-weight-semi-bold py-2 px-3">
                            </div>
                        </form>
                    </div>
                    <!-- Comment Form End -->
                </div>

                @include('partials.side')
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
