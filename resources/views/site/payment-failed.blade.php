@extends('site.payment-layout')
@section('title')Payment Failed @stop
@section('content')
<section class="payment-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="payment-status">
                    <h1 class="title">Payment Failed</h1>
                    <p class="info">{{$msg}}</p>
                    @if(isset($errors))<p class="info">{{$errors}}</p>@endif
                    <a href="{{$domain}}" class="btn btn-theme">Action goes here</a>
                </div>
            </div>
            <div class="col-lg-6 order-lg-first">
                <div class="payment-pic">
                    <img src="{{asset('site-assets/img/payment-failed.png')}}" class="img-fluid" alt="payment-success">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection