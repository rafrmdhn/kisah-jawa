@extends('layouts.main')

@section('container')
    <!-- Breadcrumb -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="{{ url('/') }}">Home</a>
                <span class="breadcrumb-item active">
                    {{ $activeCategory->name ?? 'Semua Kategori' }}
                </span>
            </nav>
        </div>
    </div>

    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">{{ $activeCategory->name ?? 'Semua Kategori' }}</h3>
                    </div>

                    @php $visibleCount = 8; @endphp
                    <style>
                        .chipbar{display:flex;gap:8px;overflow-x:auto;white-space:nowrap;padding:8px 0;margin-bottom:14px;}
                    </style>

                    <div class="chipbar" id="chipbar">
                        <a href="{{ route('category.index') }}"
                           class="btn btn-sm m-1 {{ empty($activeSlug) ? 'btn-secondary' : 'btn-outline-secondary' }}">Semua</a>

                        @foreach($categories as $i => $cat)
                            <a href="{{ route('category.index', ['cat' => $cat->slug]) }}"
                                 class="btn btn-sm m-1 {{ $activeSlug === $cat->slug ? 'btn-secondary' : 'btn-outline-secondary' }} {{ $i >= $visibleCount ? 'btn-hidden' : '' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach

                        @if($categories->count() > $visibleCount)
                            <button type="button"
                            class="btn btn-sm btn-outline-secondary m-1"
                            id="catToggle">Lainnya</button>
                        @endif
                    </div>

                    <script>
                        (function(){
                          const bar=document.getElementById('chipbar');
                          const btn=document.getElementById('chipToggle');
                          if(!bar||!btn) return;
                          let expanded=false;
                          btn.addEventListener('click',function(){
                              expanded=!expanded;
                              bar.classList.toggle('is-expanded',expanded);
                              btn.textContent=expanded?'Lebih sedikit':'Lainnya';
                          });
                        })();
                    </script>

                    <div class="row">
                        @foreach($articles as $key => $article)
                            @if($key < 4)
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="{{ $article->sumber_gambar }}" style="object-fit:cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size:14px;">
                                                <a href="{{ route('category.index', ['cat' => $article->category->slug]) }}">
                                                    {{ $article->category->name }}
                                                </a>
                                                <span class="px-1">/</span>
                                                <span>{{ \Carbon\Carbon::parse($article->tanggal_posting)->diffForHumans() }}</span>
                                            </div>
                                            <a class="h4" href="{{ route('articles.show', $article->slug) }}">{{ $article->judul }}</a>
                                            <p class="m-0">{{ Str::limit(strip_tags($article->deskripsi), 100) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Ads --}}
                    <div class="mb-3">
                        <a href="#"><img class="img-fluid w-100" src="/img/ads-700x70.jpg" alt=""></a>
                    </div>

                    <div class="row">
                        @foreach($articles as $key => $article)
                            @if($key < 4) @continue @endif
                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <img src="{{ $article->sumber_gambar }}" style="width:100px;height:100px;object-fit:cover;">
                                    <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height:100px;">
                                        <div class="mb-1" style="font-size:13px;">
                                            <a href="{{ route('category.index', ['cat' => $article->category->slug]) }}">
                                                {{ $article->category->name }}
                                            </a>
                                            <span class="px-1">/</span>
                                            <span>{{ \Carbon\Carbon::parse($article->tanggal_posting)->diffForHumans() }}</span>
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
@endsection
