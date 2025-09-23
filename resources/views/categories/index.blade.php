@extends('layouts.main')

@section('container')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="{{ url('/') }}">Home</a>
                <span class="breadcrumb-item active">All Categories</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Categories List Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">All Categories</h3>
                    </div>

                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-6 mb-4">
                                <div class="bg-light d-flex flex-column justify-content-center text-center p-4 h-100">
                                    <h5 class="mb-2">{{ $category->name }}</h5>
                                    <p class="mb-2">{{ $category->articles_count }} Articles</p>
                                    <a href="{{ route('category.show', $category->slug) }}" class="btn btn-primary btn-sm">
                                        View Articles
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @include('partials.side')
            </div>
        </div>
    </div>
    <!-- Categories List End -->
@endsection
