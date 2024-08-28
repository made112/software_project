<!doctype html>
<html>

<head>

    <meta charset="utf-8">
    <title>CyberX :: @yield('subject') </title>
</head>

<body style="padding:0; margin:0; width: 100%;">
    <table style="width: 100%; background:#F5F6FA; font-family: sans-serif;" dir="ltr">
        <tr>
            <td>
                <table style="max-width: 636px; width: 100%; margin: 60px auto; border-spacing: 0">
                    <tr>
                        <td style="padding: 0 60px; background: #fff; border-radius: 10px 10px 0 0 ;">
                            <table style="width: 100%; margin: auto; border-spacing: 0px; margin-bottom: 2rem">
                                <!-- Logo -->
                                <tr>
                                    <td style="text-align:center; padding: 60px 0 40px">
                                        <a href="{{ route('admin.login') }}">
                                            <img src="{{ asset('email_assets/assets/img/email_logo.png') }}" alt="logo">
                                        </a>
                                    </td>
                                </tr>
                                @yield('content')
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 37px 0; text-align: center; background: #595874; border-radius: 0px 0px 10px 10px;">
                            <p style="color:#fff; font-size: 16px; margin: 0; margin-bottom: 10px; font-family:Almarai;">
                                {{ __('lang.contact_us') }}
                            </p>
                            <a href="tel:+966533366666" dir="ltr" style=" display: block; color: #fff; font-size: 18px; text-decoration: none; margin-bottom: 12px; font-family:Almarai;">
                                {{ __('lang.mobile') }}: {{ $site_setting->mobile }}
                            </a>
                            <a href="mailto:info@bullyx.com" dir="ltr" style=" display: block; color: #fff; font-size: 18px; text-decoration: none; margin-bottom: 27px; font-family:Almarai;">
                                {{ __('lang.email') }}:  {{ $site_setting->email }}
                            </a>
                            <p style="color:#fff; font-size: 14px; margin: 0; margin-bottom: 15px; font-family:Almarai;">
                                {{ __('lang.thank_you') }}
                            </p>
                            <p style="color:#fff; font-size: 14px; margin: 0;  margin: 0; font-family:Almarai;">
                                {{ __('lang.support_team') }}
                            </p>
                        </td>
                    </tr>
                    <!-- footer -->
                    <tr>
                        <td style="padding-top: 30px; text-align: center;">
                            <ul style=" list-style-type: none; font-size: 12px; color: #383B37; margin: 0; padding: 0; list-style: none; padding-bottom: 0">
                                <li style="display: inline-block;">
                                    <a href="{{URL::to('/')}}/page/unsubscribe" style="padding: 0 0.5rem; text-decoration: none; color: #383B37;">
                                        {{ __('lang.unsubscribe') }}
                                    </a>
                                </li>
                                <li style="display: inline-block; padding: 0 0.5rem; text-decoration: none; color: #383B37;">|</li>
                                <li style="display: inline-block;">
                                    <a href="{{URL::to('/')}}/page/privacy" style="padding: 0 0.5rem; text-decoration: none; color: #383B37;">
                                        {{ __('lang.privacy') }}
                                    </a>
                                </li>
                                <li style="display: inline-block; padding: 0 0.5rem; text-decoration: none; color: #383B37;">|</li>
                                <li style="display: inline-block;">
                                    <a href="{{URL::to('/')}}/page/terms-conditions" style="padding: 0 0.5rem; text-decoration: none; color: #383B37;">
                                        {{ __('lang.terms_of_conditions') }}
                                    </a>
                                </li>
                            </ul>
                            <p style="color:#383B37; font-size: 12px; direction: ltr; margin: 0; padding: 16px 0">
                                {{ __('lang.saved_copyrights') }}  {{ date('Y') }}
                            </p>
                            <ul style=" list-style-type: none; font-size: 16px; color: #fff; margin: 0; padding: 0; list-style: none; padding-bottom: 0">
                                <li style="display: inline-block;">
                                    <a href="{{ $site_setting->linkedin }}" style="padding: 0 0.5rem">
                                        <img src="{{ asset('email_assets/assets/img/LinkedIn.png') }}">
                                    </a>
                                </li>
                                <li style="display: inline-block;">
                                    <a href="{{ $site_setting->twitter }}" style="padding: 0 0.5rem">
                                        <img src="{{ asset('email_assets/assets/img/Twitter.png') }}">
                                    </a>
                                </li>
                                <li style="display: inline-block;">
                                    <a href="{{ $site_setting->instagram }}" style="padding: 0 0.5rem">
                                        <img src="{{ asset('email_assets/assets/img/instagram.png') }}">
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
