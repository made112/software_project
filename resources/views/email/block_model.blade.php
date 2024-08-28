@extends('email.layouts.master')

@section('subject', $data['title'])

@section('content')
    <!-- title -->

    <tr>
        @if(isset($data['flag']))
            @if($data['flag'] == 1)
                <td style=" padding-bottom: 10px; text-align: center;">
                    <p style="color:#595874; font-size: 18px; margin: 0; ; font-weight: bold; font-family:Almarai;">
                    <img src="{{ url('email_assets/assets/img/check.png') }}">
                    {{ $data['title'] }}
                </p>
            </td>
            @else
                <td style=" padding-bottom: 10px; text-align: center;">
                    <p style="color:#595874; font-size: 18px; margin: 0; ; font-weight: bold; font-family:Almarai;">
                    <img src="{{ url('email_assets/assets/img/x.png') }}">
                    {{ $data['title'] }}
                </p>
            </td>
            @endif
        @else
            <td style=" padding-bottom: 10px; text-align: center;">
                <p style="color:#595874; font-size: 18px; margin: 0; ; font-weight: bold; font-family:Almarai;">
                    <img src="{{ url('email_assets/assets/img/x.png') }}">
                    {{ $data['title'] }}
                </p>
            </td>
        @endif
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px;; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/admin_license.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="padding-bottom: 0; border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 14px; margin-bottom: 26px">
                {{ __('lang.hello_user' , ['user' => object_get($user , 'name')]) }}
            </p>
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">
                {{ $data['content'] }}
            </p>
            @if(isset($data['license_code']))
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">
               {{$data['license_code']}}
            </p>
            @endif
            @if(isset($data['product']))
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">
               {{$data['product']}}
            </p>
            @endif
        </td>
    </tr>
    <tr>
        <td style=" text-align: center; padding-bottom: 35px;">
            <a href="{{URL::to('/')}}" style="
                    display: inline-block;
                    margin: auto; margin-top: 20px; text-align: center;
                    width: 200px; height: 50px; line-height: 50px;
                    background: #595874; text-decoration: none;
                    border-radius: 5px; color: #fff;">
                {{ __('lang.contact_support') }}
            </a>
        </td>
    </tr>
@endsection
