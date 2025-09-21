@extends('layouts.main')

@section('container')
    <!-- Top News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
                @foreach($topNews as $news)
                <div class="d-flex">
                    <img src="{{ $news->sumber_gambar }}" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                        <a class="text-secondary font-weight-semi-bold" href="{{ route('articles.show', $news->slug) }}">{{ $news->judul }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Top News Slider End -->


    <!-- Main News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                        @foreach($mainNews as $news)
                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="{{ $news->sumber_gambar }}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="text-white" href="">{{ $news->category->name }}</a>
                                    <span class="px-2 text-white">/</span>
                                    <span class="text-white">{{ \Carbon\Carbon::parse($news->tanggal_posting)->format('F d, Y') }}</span>
                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="{{ route('articles.show', $news->slug) }}">{{ $news->judul }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Categories</h3>
                        <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="https://images.hukumonline.com/frontend/lt649d88d229c26/lt649d896cc6261.jpg" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Kriminal
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="https://cdnpro.eraspace.com/media/mageplaza/blog/post/1/9/1931222270_1.jpg" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Misteri
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="https://www.nyfa.edu/wp-content/uploads/2017/06/howtowriteafilmreview.png" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Film & Review
                        </a>
                    </div>
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="https://asani.co.id/wp-content/uploads/2024/02/jenis-opini-audit.webp" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            Opini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


    <!-- Featured News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0">Featured</h3>
                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
            </div>
            <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
                @foreach($featuredNews as $news)
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid w-100 h-100" src="{{ $news->sumber_gambar }}" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-1" style="font-size: 13px;">
                            <a class="text-white" href="">{{ $news->category->name }}</a>
                            <span class="px-1 text-white">/</span>
                            <span class="text-white">{{ \Carbon\Carbon::parse($news->tanggal_posting)->format('F d, Y') }}</span>
                        </div>
                        <a class="h4 m-0 text-white" href="{{ route('articles.show', $news->slug) }}">{{ ($news->judul) }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <!-- Featured News Slider End -->


    <!-- Category News Slider Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                @foreach($categories->take(4) as $category)
                    <div class="col-lg-6 py-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">{{ $category->name }}</h3>
                        </div>
                        <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                            @foreach($category->articles as $artikel)
                                <div class="position-relative">
                                    <img class="img-fluid w-100" src="{{ $artikel->sumber_gambar }}" style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href="">{{ $artikel->category->name }}</a>
                                            <span class="px-1">/</span>
                                            <span>{{ \Carbon\Carbon::parse($news->tanggal_posting)->format('F d, Y') }}</span>
                                        </div>
                                        <a class="h4 m-0" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category News Slider End -->

    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Populer</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>

                        {{-- Kolom kiri --}}
                        <div class="col-lg-6">
                            @foreach($popularLeft as $key => $artikel)
                                @if($key === 0)
                                    {{-- Artikel besar --}}
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="{{ $artikel->sumber_gambar }}" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href="">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h4" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                            {{ Str::limit(strip_tags($artikel->deskripsi), 120) }}
                                        </div>
                                    </div>
                                @else
                                    {{-- Artikel kecil --}}
                                    <div class="d-flex mb-3">
                                        <img src="{{ $artikel->sumber_gambar }}" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h6 m-0" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- Kolom kanan --}}
                        <div class="col-lg-6">
                            @foreach($popularRight as $key => $artikel)
                                @if($key === 0)
                                    {{-- Artikel besar --}}
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="{{ $artikel->sumber_gambar }}" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h4" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                            {{ Str::limit(strip_tags($artikel->deskripsi), 120) }}
                                        </div>
                                    </div>
                                @else
                                    {{-- Artikel kecil --}}
                                    <div class="d-flex mb-3">
                                        <img src="{{ $artikel->sumber_gambar }}" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h6 m-0" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Terbaru</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>

                        {{-- Kolom kiri --}}
                        <div class="col-lg-6">
                            @foreach($latestLeft as $key => $artikel)
                                @if($key === 0)
                                    {{-- Artikel besar --}}
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="{{ $artikel->sumber_gambar }}" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h4" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                            {{ Str::limit(strip_tags($artikel->deskripsi), 120) }}
                                        </div>
                                    </div>
                                @else
                                    {{-- Artikel kecil --}}
                                    <div class="d-flex mb-3">
                                        <img src="{{ $artikel->sumber_gambar }}" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h6 m-0" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- Kolom kanan --}}
                        <div class="col-lg-6">
                            @foreach($latestRight as $key => $artikel)
                                @if($key === 0)
                                    {{-- Artikel besar --}}
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="{{ $artikel->sumber_gambar }}" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h4" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                            {{ Str::limit(strip_tags($artikel->deskripsi), 120) }}
                                        </div>
                                    </div>
                                @else
                                    {{-- Artikel kecil --}}
                                    <div class="d-flex mb-3">
                                        <img src="{{ $artikel->sumber_gambar }}" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h6 m-0" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($artikel->judul, 50) }}</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                @include('partials.side')
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
