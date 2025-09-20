@extends('layouts.main')

@section('container')
    <!-- Top News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
                @foreach($topNews as $news)
                <div class="d-flex">
                    <img src="{{ asset('storage/' . $news->sumber_gambar) }}" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                        <a class="text-secondary font-weight-semi-bold" href="">{{ $news->judul }}</a>
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
                                    <a class="text-white" href="">{{ \Carbon\Carbon::parse($news->tanggal_posting)->format('d F Y') }}</a>
                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="">{{ $news->judul }}</a>
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
                    @foreach($categories as $category)
                    <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="img/cat-500x80-1.jpg" style="object-fit: cover;">
                        <a href="" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            {{ $category->name }}
                        </a>
                    </div>
                    @endforeach
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
                            <a class="text-white" href="">{{ $news->tanggal_posting }}</a>
                        </div>
                        <a class="h4 m-0 text-white" href="">{{ $news->judul }}</a>
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
                @foreach($categories as $category)
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
                                            <span>{{ $artikel->tanggal_posting }}</span>
                                        </div>
                                        <a class="h4 m-0" href="">{{ $artikel->judul }}</a>
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
                                <h3 class="m-0">Popular</h3>
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
                                                <a href="#">{{ $artikel->category->name }}</a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($artikel->tanggal_posting)->format('F d, Y') }}</span>
                                            </div>
                                            <a class="h4" href="">{{ $artikel->judul }}</a>
                                            <p class="m-0">{{ Str::limit($artikel->deskripsi, 120) }}</p>
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
                                            <a class="h6 m-0" href="">{{ $artikel->judul }}</a>
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
                                            <a class="h4" href="">{{ $artikel->judul }}</a>
                                            <p class="m-0">{{ Str::limit($artikel->deskripsi, 120) }}</p>
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
                                            <a class="h6 m-0" href="">{{ $artikel->judul }}</a>
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
                                <h3 class="m-0">Latest</h3>
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
                                            <a class="h4" href="">{{ $artikel->judul }}</a>
                                            <p class="m-0">{{ Str::limit($artikel->deskripsi, 120) }}</p>
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
                                            <a class="h6 m-0" href="">{{ $artikel->judul }}</a>
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
                                            <a class="h4" href="">{{ $artikel->judul }}</a>
                                            <p class="m-0">{{ Str::limit($artikel->deskripsi, 120) }}</p>
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
                                            <a class="h6 m-0" href="">{{ $artikel->judul }}</a>
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
