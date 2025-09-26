@extends('layouts.main')

@section('container')
    <style>
        .news-card {
            display: grid;
            grid-template-columns: 320px 1fr;
            background: #ffffff;
            overflow: hidden;
        }

        .news-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 768px) {
            .news-card {
            grid-template-columns: 1fr;
            }
            .news-thumb {
            height: 220px;
            }
        }
    </style>

    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="{{ url('/') }}">Home</a>
                <span class="breadcrumb-item active">Trending</span>
            </nav>
        </div>
    </div>

    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <!-- Main -->
                <div class="col-lg-8">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Trending</h3>
                        <div class="btn-group btn-group-sm" role="group" aria-label="range">
                            <a class="btn btn-outline-secondary {{ $range==1?'active':'' }}"
                               href="{{ route('trending.index', ['range'=>1]) }}">24 Jam</a>
                            <a class="btn btn-outline-secondary {{ $range==7?'active':'' }}"
                               href="{{ route('trending.index', ['range'=>7]) }}">7 Hari</a>
                            <a class="btn btn-outline-secondary {{ $range==30?'active':'' }}"
                               href="{{ route('trending.index', ['range'=>30]) }}">30 Hari</a>
                        </div>
                    </div>

                    <div class="row row-cols-1 g-4">
                        @foreach($articles as $article)
                            <div class="col">
                                <article class="news-card mb-4">
                                    <div class="news-thumb">
                                        <img src="{{ $article->sumber_gambar }}" alt="{{ $article->judul }}" loading="lazy">
                                    </div>

                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 14px;">
                                            <a href="{{ route('category.show', $article->category->slug) }}">{{ $article->category->name }}</a>
                                            <span class="px-1">/</span>
                                            <span>{{ \Carbon\Carbon::parse($article->tanggal_posting)->format('F d, Y') }}</span>
                                        </div>

                                        <a class="h5 mb-1" href="{{ route('articles.show', $article->slug) }}">{{ Str::limit($article->judul, 80) }}</a>
                                        <p class="m-0">{{ Str::limit(strip_tags($article->deskripsi), 140) }}</p>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="row">
                        <div class="col-12">
                            {{ $articles->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                @include('partials.side')
            </div>
        </div>
    </div>
@endsection
