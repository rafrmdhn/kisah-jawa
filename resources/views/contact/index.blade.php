@extends('layouts.main')

@section('container')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="{{ url('/') }}">Beranda</a>
                <span class="breadcrumb-item active">Kontak</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="bg-light py-2 px-4 mb-3">
                <h3 class="m-0">Kirimkan pesan kepada kami</h3>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="bg-light mb-3" style="padding: 30px;">
                        <h6 class="font-weight-bold">Hubungi kami</h6>
                        <p>Apakah Anda memiliki pertanyaan tentang talent, harga, portofolio, atau hal lain, tim kami siap menjawab semua pertanyaan Anda.</p>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                            <div class="d-flex flex-column">
                                <h6 class="font-weight-bold">Alamat</h6>
                                <p class="m-0">Residence One BSD, Jl. Raya Serpong Kilometer 7, Jelupang, Kec. Serpong Utara,Kota Tangerang Selatan, Banten 15310</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-2x fa-envelope-open text-primary mr-3"></i>
                            <div class="d-flex flex-column">
                                <h6 class="font-weight-bold">Email</h6>
                                <p class="m-0">partnership@fypmedia.id</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-2x fa-phone-alt text-primary mr-3"></i>
                            <div class="d-flex flex-column">
                                <h6 class="font-weight-bold">Telepon</h6>
                                <p class="m-0">+62 851 7512 3014‬ (Jaya)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="contact-form bg-light mb-3" style="padding:30px;">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" class="form-control p-4" placeholder="Nama"
                                                value="{{ old('name') }}" required>
                                        @error('name')
                                            <p class="help-block text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control p-4" placeholder="Email"
                                            value="{{ old('email') }}" required>
                                    @error('email')
                                        <p class="help-block text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" name="telp" class="form-control p-4" placeholder="No. Telepon"
                                                value="{{ old('telp') }}" required>
                                        @error('telp')
                                            <p class="help-block text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" name="subject" class="form-control p-4" placeholder="Subjek"
                                                value="{{ old('subject') }}" required>
                                        @error('subject')
                                            <p class="help-block text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                                <div class="form-group mb-3">
                                    <textarea name="message" rows="4" class="form-control" placeholder="Pesan" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="help-block text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <button class="btn btn-primary font-weight-semi-bold px-4" style="height:50px;" type="submit">
                                        Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
