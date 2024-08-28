@extends('layouts.error_layout')

@section('error_title', 'Forbidden')

@section('error_content')
    <!-- Start ( 403 ) -->
    <section class="error-section error-403">
        <div class="error-card">
            <div class="pic">
                <img src="{{ asset('error_assets/img/403.svg') }}" alt="">
            </div>
            <div class="content">
                <h1 class="title"> Access Denied/Forbidden </h1>
                <p class="info"> You don’t have access to this page </p>
                <div class="option">
                    <a href="{{ route('home') }}" class="btn btn-theme" onclick="history.go(-1)"> Back to Home </a>
                    <a href="javascript:;" class="btn btn-outline-theme" onclick="history.go(-1)"> Request Access </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End ( 403 ) -->
@endsection
