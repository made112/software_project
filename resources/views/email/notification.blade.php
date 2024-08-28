@extends('email.layouts.master')

@section('subject', $data->notification_title)

@section('content')
    <!-- title -->
   
            @if($data->notification_type == 1)
                <tr>
                    <td style=" padding-bottom: 30px; text-align: center;"> 
                        <p style="color:#383B37; font-size: 18px; margin: 0">{{ $data->notification_title }}</p>
                    </td> 
                </tr>
                <tr>
                    <td style=" padding-bottom: 50px; text-align: center;"> 
                        <img src="{{ asset('email_assets/assets/img/update.png')}}" width="284" alt="">
                    </td> 
                </tr>
            @elseif($data->notification_type == 2) 
                <tr>
                    <td style=" padding-bottom: 30px; text-align: center;"> 
                        <p style="color:#383B37; font-size: 18px; margin: 0"> {{ $data->notification_title }}</p>
                    </td> 
                </tr>
                <tr>
                    <td style=" padding-bottom: 50px; text-align: center;"> 
                        <img src="{{ asset('email_assets/assets/img/New-Content.png')}}" width="284" alt="">
                    </td> 
                </tr>
            @elseif($data->notification_type == 3)
            <tr>
                <td style=" padding-bottom: 30px; text-align: center;"> 
                    <p style="color:#EC5A5A; font-size: 18px; margin: 0">
                        <img src="{{ asset('email_assets/assets/img/danger.png')}}"> 
                        {{ $data->notification_title }}
                    </p>
                </td> 
            </tr>
            
            <tr>
                <td style=" padding-bottom: 50px; text-align: center;"> 
                    <img src="{{ asset('email_assets/assets/img/Expired.png') }}" width="284" alt="">
                </td> 
            </tr>
            @endif
    <!-- info -->
    <tr>
        <td style="padding-bottom: 0; border-radius: 5px; background-color: #F5F6FA; padding: 30px; margin-bottom: 30px; display: block; ">
            <p style="color:#383B37; font-size: 14px; margin-bottom: 26px">
                {{ __('lang.hello_user', ['user' => $user->name]) }} ,
            </p>
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">
                {!! $data->notification_content !!}
            </p> 
        </td>
    </tr>
@endsection
