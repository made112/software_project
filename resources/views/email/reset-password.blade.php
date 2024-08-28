@extends('email.layouts.master')

@section('subject', trans('lang.reset-password'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ trans('lang.reset-password')}}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px; text-align: center;">
            <img src="{{ url('email_assets/assets/img/email_success.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>

        <td style="border-radius: 5px; background-color: #F5F6FA; padding: 30px; text-align: center">
            <p style="color:#383B37; font-size: 14px; font-weight: 400; font-family:Almarai; ">
                {{ 'We have received your request to reset your password. Just click on the button given below.' }},
            </p>
            <a href="{{$url}}" target="_blank"
               style="
                display: inline-block;
                margin: auto;
                margin-top: 10px;
                text-align: center;
               width: 200px;
              height: 50px;
                      line-height: 50px;
                    background: #595874;
                     text-decoration: none;
                    border-radius: 5px;
                     color: #fff;">
                {{ __('lang.reset-password') }}
            </a>
            <p style="color:#383B37; font-size: 14px; font-weight: 400; font-family:Almarai; ">
                {{ 'If the button doesn\'t work, copy-paste this URL in your browser\'s address bar' }}
            </p>
            <a href="{{$url}}" target="_blank">
                {{$url}}
            </a>
        </td>
    </tr>

@endsection
