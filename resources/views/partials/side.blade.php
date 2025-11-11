<div class="col-lg-4 pt-3 pt-lg-0">
    <!-- Social Follow Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Follow Us</h3>
        </div>
        <div class="d-flex mb-3">
            <a href="https://linkedin.com/company/fypgroup/" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                <small class="fab fa-linkedin-in mr-2"></small><small>Linkedin</small>
            </a>
            <a href="https://www.instagram.com/fypmedia.id" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                <small class="fab fa-instagram mr-2"></small><small>Instagram</small>
            </a>
        </div>
        <div class="d-flex mb-3">
            <a href="https://www.youtube.com/@fypmediaid" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                <small class="fab fa-youtube mr-2"></small><small>Youtube</small>
            </a>
            <a href="https://www.tiktok.com/@fypmedia.id" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1d1d1d;">
                <small class="fab fa-tiktok mr-2"></small><small>Tiktok</small>
            </a>
        </div>
    </div>
    <!-- Social Follow End -->

    <!-- Ads Start -->
    <div class="mb-3 pb-3">
        <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
    </div>
    <!-- Ads End -->

    <!-- Popular News Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Trending</h3>
        </div>
        @foreach($trendingNews as $news)
            <div class="d-flex mb-3">
                <img src="{{ $news->gambar }}" style="width: 100px; height: 100px; object-fit: cover;">
                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                    <div class="mb-1" style="font-size: 13px;">
                        <a href="{{ route('category.index', ['cat' => $news->category->slug]) }}">{{ $news->category->name }}</a>
                        <span class="px-1">/</span>
                        <span>{{ \Carbon\Carbon::parse($news->tanggal_posting)->diffForHumans() }}</span>
                    </div>
                    <a class="h6 m-0" href="{{ route('articles.show', $news->slug) }}">{{ Str::limit($news->judul, 30) }}</a>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Popular News End -->

    <!-- Tags Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Tags</h3>
        </div>
        <div class="d-flex flex-wrap m-n1">
            @foreach(($article->tags ?? $tags) as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}" class="btn btn-sm btn-outline-secondary m-1">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
    <!-- Tags End -->
</div>
