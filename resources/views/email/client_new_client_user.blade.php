@extends('email.layouts.master')

@section('subject', __('mail.new_client_user_title'))

@section('content')

    @php
        $company = \App\Models\Clients::find($clientUser->client_id);
    @endphp
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ __('mail.new_client_user_title') }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/new_client_image.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="padding-bottom: 0; border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 16px; font-weight: bold; font-family:Almarai; ">
                {{ __('lang.hello_user' , ['user' => $company->name]) }},
            </p>
            <p style="color:#383B37; font-size: 15px; font-weight: 500; font-family:Almarai; ">
                {{ __('lang.new_user_content') }}
            </p>
            <table>
                <tr style="text-align: left; color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai;">
                    <th>{{ __('lang.name') }}</th>
                    <td>{{ $clientUser->name }}</td>
                </tr>
                <tr style="text-align: left; color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai;">
                    <th>{{ __('lang.id') }}</th>
                    <td>{{ $clientUser->id }}</td>
                </tr>
                <tr style="text-align: left; color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai;">
                    <th>{{ __('lang.job_title') }}</th>
                    <td>{{ $clientUser->job_title }}</td>
                </tr>
                <tr style="text-align: left; color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai;">
                    <th>{{ __('lang.email') }}</th>
                    <td>{{ $clientUser->email }}</td>
                </tr>
            </table>
        </td>
    </tr>
@endsection