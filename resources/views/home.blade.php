@extends('layouts.app')
@vite(['resources/sass/home.scss', 'resources/js/app.js'])
@section('title', 'Home')

@section('content')
    <div class="container-fluid g-0">
        <section class="container-fluid pt-3 h-10" id="homepageTop">
            <h1>Selamat datang, atmin</h1>
            <p>Mulai operasi website dengan navbar di atas</p>
        </section>
        <section class="container-fluid g-0 bg-body-secondary">
            <div class="container-fluid">
                <h3>Berita terbaru</h3>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card ">
                            <img src="{{ asset('img/Cyca_Books_1800.jpg') }}" alt="Book Cover" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Lorem Ipsum</h6>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis rutrum diam, vel varius erat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card ">
                            <img src="{{ asset('img/Cyca_Books_1800.jpg') }}" alt="Book Cover" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Lorem Ipsum</h6>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis rutrum diam, vel varius erat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card ">
                            <img src="{{ asset('img/Cyca_Books_1800.jpg') }}" alt="Book Cover" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Lorem Ipsum</h6>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis rutrum diam, vel varius erat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card ">
                            <img src="{{ asset('img/Cyca_Books_1800.jpg') }}" alt="Book Cover" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Lorem Ipsum</h6>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis rutrum diam, vel varius erat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card ">
                            <img src="{{ asset('img/Cyca_Books_1800.jpg') }}" alt="Book Cover" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Lorem Ipsum</h6>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis rutrum diam, vel varius erat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection