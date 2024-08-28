@extends('layouts.error_layout')

@section('error_title', 'Internal Server Error')

@section('error_content')

    <!-- Start ( 500 ) Internal Server Error -->
    <section class="error-section error-500">
        <div class="error-card">
            <div class="pic">
                <img src="{{ asset('error_assets/img/500.svg') }}" alt="">
            </div>
            <div class="content">
                <h1 class="title"> Internal Server Error ! </h1>
                <p class="info"> The server has been deserted for a while, Please be patient or try again later </p>
                <div class="option">
                    <a href="{{ route('home') }}" class="btn btn-theme" onclick="history.go(-1)"> Back to Home </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End ( 500 ) Internal Server Error -->

@endsection
