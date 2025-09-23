@extends('layouts.main')

@section('container')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="/">Home</a>
                <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a>
                <span class="breadcrumb-item active">{{ $category->name }}</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">{{ $category->name }}</h3>
                            </div>
                        </div>
                        @foreach($articles as $key => $article)
                            @if($key < 4)
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="{{ $article->sumber_gambar }}" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href="{{ route('category.show', $article->category->slug) }}">
                                                    {{ $article->category->name }}
                                                </a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($article->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h4" href="{{ route('articles.show', $article->slug) }}">{{ $article->judul }}</a>
                                            <p class="m-0">{{ Str::limit(strip_tags($article->deskripsi), 100) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                    </div>

                    <div class="row">
                        @foreach($articles as $key => $article)
                            @if($key < 4)
                                @continue
                            @endif
                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <img src="{{ $article->sumber_gambar }}" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                        <div class="mb-1" style="font-size: 13px;">
                                            <a href="{{ route('category.show', $article->category->slug) }}">
                                                {{ $article->category->name }}
                                            </a>
                                            <span class="px-1">/</span>
                                            <span>{{ \Carbon\Carbon::parse($article->tanggal_posting)->format('F d, Y') }}</span>
                                        </div>
                                        <a class="h6 m-0" href="{{ route('articles.show', $article->slug) }}">
                                            {{ $article->judul }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12 justify-content-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{ $articles->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                @include('partials.side')
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
