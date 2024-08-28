@extends('layouts.error_layout')

@section('error_title', 'Not Found')

@section('error_content')

    <!-- Start ( 404 ) Not Found -->
    <section class="error-section error-403">
        <div class="error-card">
            <div class="pic">
                <img src="{{ asset('error_assets/img/404.svg') }}" alt="">
            </div>
            <div class="content">
                <h1 class="title"> Oops! Page not found </h1>
                <p class="info"> The page you are looking for not avilable </p>
                <div class="option">
                    <a href="{{ route('home') }}" class="btn btn-theme" onclick="history.go(-1)">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End ( 404 ) Not Found -->

@endsection
