@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.tickets_show') }}
@stop
@section('css')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/jqvmap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/custom.css?v=1.0.2') }}">
    <link href="{{ asset('admin-assets/assets/app/plugins.bundle.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/freshdesk/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/freshdesk/css/custom.css') }}">

@stop
@section('page-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->

        <!-- END: Subheader -->
        <div class="m-content mb-3">
            <div class="row">

                <div class="col-lg-12">

                    <div class="m-subheader p-0 ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="#" class="m-nav__link m-nav__link--icon">
                                            <i class="m-nav__link-icon la la-home text-dark"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/dashboard" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                  style="font-weight:bold">{{ trans('lang.dashboard') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.tickets_show') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="m-demo__preview  m-demo__preview--btn">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="freshdesk">
            <div class="freshdesk-wrapper h-auto">
                <div class="freshdesk-view">
                    <div class="freshdesk-option d-flex justify-content-between">
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="#!" class="nav-link btn-reply" data-msg-id="1" data-email="{{ $ticket->email }}" data-toggle="tooltip" title="Reply">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.73438 4.94141L3.68569 9.99974L8.73437 15.0581" stroke="#3D3D3D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.5781 16.6667V11C16.5781 10.4477 16.1304 10 15.5781 10L3.82749 10" stroke="#3D3D3D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="ms-2"> Reply </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#!" class="nav-link forward" data-toggle="tooltip" title="forward" id="forward">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.2363 4.94141L17.285 9.99974L12.2363 15.0581" stroke="#3D3D3D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4.39258 16.6667V11C4.39258 10.4477 4.84029 10 5.39258 10H17.1432" stroke="#3D3D3D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="ms-2"> forward </span>
                                </a>
                            </li>
                            @if( $ticket->status != 4 )
                                <li class="nav-item">
                                    <form action="{{ route('ticket.close', ['id' => $ticket->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="nav-link" data-toggle="tooltip" title="close">
                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.9483 18.3337C15.5229 18.3337 19.2657 14.5837 19.2657 10.0003C19.2657 5.41699 15.5229 1.66699 10.9483 1.66699C6.37371 1.66699 2.63086 5.41699 2.63086 10.0003C2.63086 14.5837 6.37371 18.3337 10.9483 18.3337Z" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7.41211 9.99993L9.76594 12.3583L14.4819 7.6416" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="ms-2"> close </span>
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <form action="{{ route('ticket.restore', ['id' => $ticket->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="nav-link" data-toggle="tooltip" title="Restore">
                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.9483 18.3337C15.5229 18.3337 19.2657 14.5837 19.2657 10.0003C19.2657 5.41699 15.5229 1.66699 10.9483 1.66699C6.37371 1.66699 2.63086 5.41699 2.63086 10.0003C2.63086 14.5837 6.37371 18.3337 10.9483 18.3337Z" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7.41211 9.99993L9.76594 12.3583L14.4819 7.6416" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="ms-2"> Restore </span>
                                        </button>
                                    </form>
                                </li>
                            @endif
                            <li class="nav-item">
                                <button type="submit" class="nav-link danger" title="delete" data-toggle="modal" data-target="#modal-msg">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.948 4.98307C15.1782 4.70807 12.3919 4.56641 9.61388 4.56641C7.96703 4.56641 6.32017 4.64974 4.67332 4.81641L2.97656 4.98307" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.55078 4.14199L7.73377 3.05033C7.86684 2.25866 7.96665 1.66699 9.3723 1.66699H11.5515C12.9571 1.66699 13.0652 2.29199 13.19 3.05866L13.373 4.14199" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.1586 7.61621L15.6179 16.0079C15.5264 17.3162 15.4516 18.3329 13.131 18.3329H7.79122C5.47065 18.3329 5.3958 17.3162 5.30431 16.0079L4.76367 7.61621" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9.07227 13.75H11.842" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.38281 10.417H12.5415" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="ms-2"> delete </span>
                                </button>
                            </li>
                        </ul>

                        <ul class="nav">
                            <li class="nav-item">
                                <a href="#!" class="nav-link btn-edit" data-toggle="tooltip" title="edit">
                                    <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 9.50396V12.004H2.5L9.872 4.63196L7.372 2.13196L0 9.50396ZM11.805 2.69496C11.8668 2.63329 11.9158 2.56003 11.9493 2.47938C11.9827 2.39873 12 2.31227 12 2.22496C12 2.13765 11.9827 2.0512 11.9493 1.97055C11.9158 1.8899 11.8668 1.81664 11.805 1.75496L10.245 0.194963C10.1833 0.13316 10.1101 0.0841283 10.0294 0.050674C9.94877 0.0172197 9.86231 0 9.775 0C9.68769 0 9.60123 0.0172197 9.52058 0.050674C9.43994 0.0841283 9.36668 0.13316 9.305 0.194963L8.085 1.41496L10.585 3.91496L11.805 2.69496Z" fill="#3D3D3D"/>
                                    </svg>
                                    <span class="ms-2"> Edit </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Start Ticket Section --}}
                    <div class="freshdesk-view-card px-4" >
                        <div class="freshdesk-view-tickets" id="msg-box">
                            <div class="freshdesk-view-ticket msg-1">
                                <div class="ticket-view">
                                    <div class="person-card">
                                        @php
                                            $admin_email = \App\Models\Setting::query()->where('id', 1)->first();
                                        @endphp
                                        <div class="pic">
                                            <img src="{{ $ticket->client->logo }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="content w-100" style="max-width: 100%;">
                                            <div class="d-md-flex justify-content-between">
                                                <div class="data" style="max-width: 797px; width: 100%">
                                                    <h2 class="title"> {{ $ticket->client->name }} </h2>
                                                    <div class="person-msg w-100 d-block">
                                                        <div class="info">
                                                            <span class="to" style=" display: inline-block; font-size: 14px"><b> to: </b> {{ $admin_email->email }} </span>
                                                            <div class="text" style="background-color: #F6F7F9; border-radius: 6px; padding: 1rem">
                                                                <p>
                                                                    {{ $ticket->description }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="date "> {{ $ticket->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a') }} </p>
                                            </div>
                                        </div>
{{--                                        <div class="option">--}}
{{--                                            <a href="#!" class="btn btn-icon btn-forward" data-msg-id="1" data-email="alaa@krunb4itcom" data-toggle="tooltip" title="forword">--}}
{{--                                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8111 6.31076C17.871 6.25038 17.9185 6.17865 17.9509 6.09969C17.9833 6.02072 18 5.93607 18 5.85057C18 5.76508 17.9833 5.68043 17.9509 5.60146C17.9185 5.5225 17.871 5.45077 17.8111 5.39039L12.6686 0.190613C12.5479 0.0685656 12.3842 -4.06662e-09 12.2135 0C12.0428 4.06662e-09 11.8791 0.0685656 11.7584 0.190613C11.6377 0.312661 11.5699 0.478192 11.5699 0.650794C11.5699 0.823395 11.6377 0.988927 11.7584 1.11097L15.8043 5.2006H3.21408C2.36165 5.2006 1.54414 5.543 0.941382 6.15247C0.338625 6.76193 0 7.58855 0 8.45047V18.85C0 19.0224 0.067725 19.1877 0.188276 19.3096C0.308828 19.4315 0.472331 19.5 0.642816 19.5C0.813302 19.5 0.976804 19.4315 1.09736 19.3096C1.21791 19.1877 1.28563 19.0224 1.28563 18.85V8.45047C1.28563 7.93331 1.48881 7.43735 1.85046 7.07166C2.21212 6.70598 2.70262 6.50055 3.21408 6.50055H15.8043L11.7584 10.5902C11.6377 10.7122 11.5699 10.8778 11.5699 11.0504C11.5699 11.223 11.6377 11.3885 11.7584 11.5105C11.8791 11.6326 12.0428 11.7011 12.2135 11.7011C12.3842 11.7011 12.5479 11.6326 12.6686 11.5105L17.8111 6.31076Z" fill="#3D3D3D"/>--}}
{{--                                                </svg>--}}
{{--                                            </a>--}}
{{--                                            <a href="#!" class="btn btn-icon danger btn-delete"  data-msg-id="1" data-email="alaa@krunb4itcom"  data-toggle="tooltip" title="delete">--}}
{{--                                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                    <path d="M5.38401 7.15039C5.56253 7.15039 5.73373 7.21887 5.85995 7.34077C5.98618 7.46267 6.05709 7.628 6.05709 7.80039V15.6004C6.05709 15.7728 5.98618 15.9381 5.85995 16.06C5.73373 16.1819 5.56253 16.2504 5.38401 16.2504C5.2055 16.2504 5.0343 16.1819 4.90808 16.06C4.78185 15.9381 4.71094 15.7728 4.71094 15.6004V7.80039C4.71094 7.628 4.78185 7.46267 4.90808 7.34077C5.0343 7.21887 5.2055 7.15039 5.38401 7.15039ZM8.7494 7.15039C8.92791 7.15039 9.09911 7.21887 9.22534 7.34077C9.35156 7.46267 9.42248 7.628 9.42248 7.80039V15.6004C9.42248 15.7728 9.35156 15.9381 9.22534 16.06C9.09911 16.1819 8.92791 16.2504 8.7494 16.2504C8.57089 16.2504 8.39969 16.1819 8.27346 16.06C8.14724 15.9381 8.07632 15.7728 8.07632 15.6004V7.80039C8.07632 7.628 8.14724 7.46267 8.27346 7.34077C8.39969 7.21887 8.57089 7.15039 8.7494 7.15039ZM12.7879 7.80039C12.7879 7.628 12.7169 7.46267 12.5907 7.34077C12.4645 7.21887 12.2933 7.15039 12.1148 7.15039C11.9363 7.15039 11.7651 7.21887 11.6388 7.34077C11.5126 7.46267 11.4417 7.628 11.4417 7.80039V15.6004C11.4417 15.7728 11.5126 15.9381 11.6388 16.06C11.7651 16.1819 11.9363 16.2504 12.1148 16.2504C12.2933 16.2504 12.4645 16.1819 12.5907 16.06C12.7169 15.9381 12.7879 15.7728 12.7879 15.6004V7.80039Z" fill="#EC5353"/>--}}
{{--                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 3.9C17.5 4.24478 17.3582 4.57544 17.1057 4.81924C16.8533 5.06304 16.5109 5.2 16.1538 5.2H15.4808V16.9C15.4808 17.5896 15.1971 18.2509 14.6922 18.7385C14.1873 19.2261 13.5025 19.5 12.7885 19.5H4.71154C3.99749 19.5 3.3127 19.2261 2.80779 18.7385C2.30288 18.2509 2.01923 17.5896 2.01923 16.9V5.2H1.34615C0.989132 5.2 0.646732 5.06304 0.394279 4.81924C0.141826 4.57544 0 4.24478 0 3.9V2.6C0 2.25522 0.141826 1.92456 0.394279 1.68076C0.646732 1.43696 0.989132 1.3 1.34615 1.3H6.05769C6.05769 0.955218 6.19952 0.624558 6.45197 0.380761C6.70442 0.136964 7.04682 0 7.40385 0L10.0962 0C10.4532 0 10.7956 0.136964 11.048 0.380761C11.3005 0.624558 11.4423 0.955218 11.4423 1.3H16.1538C16.5109 1.3 16.8533 1.43696 17.1057 1.68076C17.3582 1.92456 17.5 2.25522 17.5 2.6V3.9ZM3.52423 5.2L3.36538 5.2767V16.9C3.36538 17.2448 3.50721 17.5754 3.75966 17.8192C4.01212 18.063 4.35452 18.2 4.71154 18.2H12.7885C13.1455 18.2 13.4879 18.063 13.7403 17.8192C13.9928 17.5754 14.1346 17.2448 14.1346 16.9V5.2767L13.9758 5.2H3.52423ZM1.34615 3.9V2.6H16.1538V3.9H1.34615Z" fill="#EC5353"/>--}}
{{--                                                </svg>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
                                    </div>

                                </div>
                            </div>
                            {{-- End Ticket Section --}}

                            @php
                                $sender = \App\Models\User::query()->where('id',\Illuminate\Support\Facades\Auth::user()->id)->first();
                            @endphp
                            {{-- Start Reply MSG Section --}}
                            @foreach( $replies as $reply )
                                <div class="freshdesk-view-ticket msg-2">
                                    <div class="ticket-view">
                                        <div class="person-card">
                                            <div class="pic">
                                                <img src="{{ $sender->photo }}" class="img-fluid" alt="">
                                            </div>
                                            <div class="content w-100" style="max-width: 100%;">
                                                <div class="d-md-flex justify-content-between">
                                                    <div class="data" style="max-width: 797px; width: 100%">
                                                        <h2 class="title"> {{ $sender->name }}<span class="ml-2"> replied</span></h2>
                                                        <div class="person-msg w-100 d-block">
                                                            <div class="info">
                                                                <span class="to" style=" display: inline-block; font-size: 14px;">
                                                                    <b> to: </b>
                                                                    {{ $ticket->client->email }}
                                                                </span>
                                                                <br>
                                                                <div class="text" style="background-color: #F6F7F9; border-radius: 6px; padding: 1rem">
                                                                    <h6>
                                                                        {{ strip_tags($reply->description) }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="date"> {{ $reply->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a') }} </p>
                                                </div>
                                            </div>
{{--                                            <div class="option">--}}
{{--                                                <a href="#!" class="btn btn-icon btn-forward" data-msg-id="2" data-email="alaa@krunb4itcom" data-toggle="tooltip" title="forword">--}}
{{--                                                    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8111 6.31076C17.871 6.25038 17.9185 6.17865 17.9509 6.09969C17.9833 6.02072 18 5.93607 18 5.85057C18 5.76508 17.9833 5.68043 17.9509 5.60146C17.9185 5.5225 17.871 5.45077 17.8111 5.39039L12.6686 0.190613C12.5479 0.0685656 12.3842 -4.06662e-09 12.2135 0C12.0428 4.06662e-09 11.8791 0.0685656 11.7584 0.190613C11.6377 0.312661 11.5699 0.478192 11.5699 0.650794C11.5699 0.823395 11.6377 0.988927 11.7584 1.11097L15.8043 5.2006H3.21408C2.36165 5.2006 1.54414 5.543 0.941382 6.15247C0.338625 6.76193 0 7.58855 0 8.45047V18.85C0 19.0224 0.067725 19.1877 0.188276 19.3096C0.308828 19.4315 0.472331 19.5 0.642816 19.5C0.813302 19.5 0.976804 19.4315 1.09736 19.3096C1.21791 19.1877 1.28563 19.0224 1.28563 18.85V8.45047C1.28563 7.93331 1.48881 7.43735 1.85046 7.07166C2.21212 6.70598 2.70262 6.50055 3.21408 6.50055H15.8043L11.7584 10.5902C11.6377 10.7122 11.5699 10.8778 11.5699 11.0504C11.5699 11.223 11.6377 11.3885 11.7584 11.5105C11.8791 11.6326 12.0428 11.7011 12.2135 11.7011C12.3842 11.7011 12.5479 11.6326 12.6686 11.5105L17.8111 6.31076Z" fill="#3D3D3D"/>--}}
{{--                                                    </svg>--}}
{{--                                                </a>--}}
{{--                                                <a href="#!" class="btn btn-icon danger btn-delete"  data-msg-id="2" data-email="alaa@krunb4itcom"  data-toggle="tooltip" title="delete">--}}
{{--                                                    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                        <path d="M5.38401 7.15039C5.56253 7.15039 5.73373 7.21887 5.85995 7.34077C5.98618 7.46267 6.05709 7.628 6.05709 7.80039V15.6004C6.05709 15.7728 5.98618 15.9381 5.85995 16.06C5.73373 16.1819 5.56253 16.2504 5.38401 16.2504C5.2055 16.2504 5.0343 16.1819 4.90808 16.06C4.78185 15.9381 4.71094 15.7728 4.71094 15.6004V7.80039C4.71094 7.628 4.78185 7.46267 4.90808 7.34077C5.0343 7.21887 5.2055 7.15039 5.38401 7.15039ZM8.7494 7.15039C8.92791 7.15039 9.09911 7.21887 9.22534 7.34077C9.35156 7.46267 9.42248 7.628 9.42248 7.80039V15.6004C9.42248 15.7728 9.35156 15.9381 9.22534 16.06C9.09911 16.1819 8.92791 16.2504 8.7494 16.2504C8.57089 16.2504 8.39969 16.1819 8.27346 16.06C8.14724 15.9381 8.07632 15.7728 8.07632 15.6004V7.80039C8.07632 7.628 8.14724 7.46267 8.27346 7.34077C8.39969 7.21887 8.57089 7.15039 8.7494 7.15039ZM12.7879 7.80039C12.7879 7.628 12.7169 7.46267 12.5907 7.34077C12.4645 7.21887 12.2933 7.15039 12.1148 7.15039C11.9363 7.15039 11.7651 7.21887 11.6388 7.34077C11.5126 7.46267 11.4417 7.628 11.4417 7.80039V15.6004C11.4417 15.7728 11.5126 15.9381 11.6388 16.06C11.7651 16.1819 11.9363 16.2504 12.1148 16.2504C12.2933 16.2504 12.4645 16.1819 12.5907 16.06C12.7169 15.9381 12.7879 15.7728 12.7879 15.6004V7.80039Z" fill="#EC5353"/>--}}
{{--                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 3.9C17.5 4.24478 17.3582 4.57544 17.1057 4.81924C16.8533 5.06304 16.5109 5.2 16.1538 5.2H15.4808V16.9C15.4808 17.5896 15.1971 18.2509 14.6922 18.7385C14.1873 19.2261 13.5025 19.5 12.7885 19.5H4.71154C3.99749 19.5 3.3127 19.2261 2.80779 18.7385C2.30288 18.2509 2.01923 17.5896 2.01923 16.9V5.2H1.34615C0.989132 5.2 0.646732 5.06304 0.394279 4.81924C0.141826 4.57544 0 4.24478 0 3.9V2.6C0 2.25522 0.141826 1.92456 0.394279 1.68076C0.646732 1.43696 0.989132 1.3 1.34615 1.3H6.05769C6.05769 0.955218 6.19952 0.624558 6.45197 0.380761C6.70442 0.136964 7.04682 0 7.40385 0L10.0962 0C10.4532 0 10.7956 0.136964 11.048 0.380761C11.3005 0.624558 11.4423 0.955218 11.4423 1.3H16.1538C16.5109 1.3 16.8533 1.43696 17.1057 1.68076C17.3582 1.92456 17.5 2.25522 17.5 2.6V3.9ZM3.52423 5.2L3.36538 5.2767V16.9C3.36538 17.2448 3.50721 17.5754 3.75966 17.8192C4.01212 18.063 4.35452 18.2 4.71154 18.2H12.7885C13.1455 18.2 13.4879 18.063 13.7403 17.8192C13.9928 17.5754 14.1346 17.2448 14.1346 16.9V5.2767L13.9758 5.2H3.52423ZM1.34615 3.9V2.6H16.1538V3.9H1.34615Z" fill="#EC5353"/>--}}
{{--                                                    </svg>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                            {{-- End Reply MSG Section --}}

                            {{-- Start Reply Section --}}
                            @if( $ticket->status != 4 )
                                <div class="freshdesk-reply-ticket" id="freshdesk-reply-ticket">
                                <div class="head mb-0">
                                    <div class="pic">
                                        <img src="{{ $sender->photo }}" alt="">
                                    </div>
                                    <div class="content">
                                        <span class="text-uppercase mr-2"> From </span>
                                        <span> <strong>{{ $sender->name }}</strong> {{ $sender->email }}</span>
                                    </div>
                                </div>
                                <div class="head">
                                    <div class="content">
                                        <span class="text-uppercase mr-2"> To </span>
                                        <span class="to-email"> <strong>{{ $ticket->client->name }}</strong>
                                            {{ $ticket->client->email }}
                                        </span>
                                        <!-- You can use tagsinput from metronic here -->
                                    </div>
                                </div>
                                <div class="body">
                                    <form action="{{ route('reply.store', ['id' => $ticket->id]) }}" method="post" id="reply">
                                        @csrf

                                        <div class="col-md-6 col-lg-6 mb-3 d-none" id="users-select">
                                            <label for="client_id">Admins</label>

                                            <div class="clearfix"></div>
                                            <select name="users" id="users" class="users form-control">
                                                <option value="">{{ 'Admins' }}</option>
                                            </select>
                                            <span style="color: #8b8b8b;" id="client_select">

                                            </span>
                                        </div>

                                        <input type="hidden" name="from_email" value="{{ $admin_email->email }}" id="from_email">
                                        <input type="hidden" name="to_email" value="{{ $ticket->email }}" id="emailTo">
                                        <div class="form-group row">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="name">
                                                    Reply
                                                </label>
                                                @error('description')
                                                <span class="text-danger d-flex">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                <textarea name="description" id="msgText" class="form-control ckeditor @error('description') is-invalid @enderror" cols="30" rows="5" placeholder="Set A Reply Here"></textarea>

                                            </div>
                                        </div>

                                        <div class="text-right mt-4">
                                            <button type="submit" class="btn btn-theme" id="reply-form">
                                                Send
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                            {{-- End Reply Section --}}
                        </div>

                        {{-- Start Filter --}}
                        <div class="freshdesk-update">
                            <div class="wrapper">
                                <div class="head">
                                    <div class="status"> Resolved late</div>
                                    <div class="date"> a day ago </div>
                                </div>
                            <!--    <div class="form body scroll-div" id="freshdesk-update"> -->
                                <div class="form">
                                    <form action="{{ route('ticket.update', ['id' => $ticket->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <div class="form-title"> PROPERTIES </div>
                                        </div>

                                        {{-- Tags --}}
                                        <div class="form-group">
                                            <label for="" class="form-label">Tags</label>
                                            <select name="" id="" class="form-control custom-select">
                                                <option value="" disabled selected> Tags</option>
                                            </select>
                                        </div>

                                        {{-- Type --}}
                                        <div class="form-group">
                                            <label for="" class="form-label">Type</label>
                                            <select name="type" id="" class="form-control custom-select">
                                                <option value="" disabled selected> Select Type</option>
                                                <option value="1" @if( $ticket->type == 1 ) selected @endif>Question</option>
                                                <option value="2" @if( $ticket->type == 2 ) selected @endif>Incident</option>
                                                <option value="3" @if( $ticket->type == 3 ) selected @endif>Problem</option>
                                                <option value="4" @if( $ticket->type == 4 ) selected @endif>Feature Request</option>
                                                <option value="5" @if( $ticket->type == 5 ) selected @endif>Refund</option>
                                            </select>
                                        </div>

                                        {{-- Status --}}
                                        <div class="form-group">
                                            <label for="" class="form-label">Status </label>
                                            <select name="status" id="" class="form-control custom-select">
                                                <option value="" disabled selected> Select Status </option>
                                                <option value="1"  @if( $ticket->status == 1 ) selected @endif> Open </option>
                                                <option value="2"  @if( $ticket->status == 2 ) selected @endif> Pending </option>
                                                <option value="3"  @if( $ticket->status == 3 ) selected @endif> Resolved </option>
                                                <option value="4"  @if( $ticket->status == 4 ) selected @endif> Closed </option>
                                                <option value="5"  @if( $ticket->status == 5 ) selected @endif> Waiting On Customer </option>
                                                <option value="6"  @if( $ticket->status == 6 ) selected @endif> Waiting On Third Party </option>
                                            </select>
                                        </div>

                                        {{-- Priority --}}
                                        <div class="form-group">
                                            <label for="" class="form-label">Priority </label>
                                            <select name="priority" id="" class="form-control custom-select">
                                                <option value="" disabled selected> Select Priority </option>
                                                <option value="1" @if( $ticket->priority == 1 ) selected @endif> Low </option>
                                                <option value="2" @if( $ticket->priority == 2 ) selected @endif> Medium </option>
                                                <option value="3" @if( $ticket->priority == 3 ) selected @endif> High </option>
                                                <option value="4" @if( $ticket->priority == 4 ) selected @endif> Urgent </option>
                                            </select>
                                        </div>

                                        {{-- Group --}}
                                        <div class="form-group">
                                            <label for="" class="form-label">Group </label>
                                            <select name="group_id" id="" class="form-control custom-select">
                                                <option value="" disabled selected> Select Group </option>
                                                @foreach( $groups as $group )
                                                    <option value="{{ $group->id }}" @if( $ticket->group_id == $group->id ) selected @endif> {{ $group->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Agent --}}
                                        <div class="form-group">
                                            <label for="" class="form-label"> Agent </label>
                                            <select name="" id="" class="form-control custom-select">
                                                <option value="" disabled selected> Select Agent </option>
                                            </select>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-theme btn-block"> UPDATE</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- End Filter --}}
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade modal-msg" id="modal-msg" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body py-5 text-center">
                        <div class="icon mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 23 20.83">
                                <g id="caution" transform="translate(-0.462 -40)">
                                    <path id="Path_10816" data-name="Path 10816" d="M19.875,60.83H4.049A3.6,3.6,0,0,1,1,59.159,3.469,3.469,0,0,1,.84,55.732L8.752,41.949a3.617,3.617,0,0,1,6.419,0l7.912,13.783a3.469,3.469,0,0,1-.157,3.428,3.6,3.6,0,0,1-3.051,1.671Zm0,0" transform="translate(0)" fill="#ec5a5a"/>
                                    <g id="Group_2194" data-name="Group 2194" transform="translate(11.244 45.139)">
                                        <path id="Path_10817" data-name="Path 10817" d="M241.615,128.2a.682.682,0,0,1,.717.64v7.686a.722.722,0,0,1-1.435,0v-7.686A.682.682,0,0,1,241.615,128.2Zm0,0" transform="translate(-240.898 -128.203)" fill="#fff"/>
                                        <ellipse id="Ellipse_326" data-name="Ellipse 326" cx="0.717" cy="0.717" rx="0.717" ry="0.717" transform="translate(0 10.087)" fill="#fff"/>
                                    </g>
                                </g>
                            </svg>
                            <h5 class="my-4"> Delete Ticket </h5>
                            <p class="info mb-4"> Are you sure you want to delete this ticket? </p>
                        </div>
                        <form action="{{ route('ticket.delete', ['id' => $ticket->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-msg-confirm px-5 mr-2" data-msg-id="0">
                                <span class=" spinner-border spinner-border-sm mr-2 d-none"></span>
                                Delete !
                            </button>
                            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin-assets/assets/freshdesk/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/freshdesk/js/custom.js') }}"></script>

    <script>
        $(document).on("click", ".btn-forward, .btn-reply, .forward", function(){
            var msgID = $(this).data("msg-id"),
                emailTo = $(this).data("email");

            $(".freshdesk-reply-ticket").find("#msgID").val(msgID);
            $(".freshdesk-reply-ticket").find("#emailTo").val(emailTo);
            $(".freshdesk-reply-ticket").find(".to-email").text(emailTo);
            $('html, body').animate({
                scrollTop: $("#freshdesk-reply-ticket").offset().top
            }, 1000);
        });

        $(document).on("click", ".btn-delete", function(){
            var msgID = $(this).data("msg-id");
            $(".modal-msg .delete-msg-confirm").attr("data-msg-id", msgID);
            $(".modal-msg").modal("show");
        });

        $(document).on("click", ".delete-msg-confirm", function(){
            let _msgID = $(".delete-msg-confirm").attr("data-msg-id");
            $(this).addClass("disabled");
            $(this).find(".spinner-border").removeClass("d-none");

            setTimeout( function() {
                $(".delete-msg-confirm").removeClass("disabled");
                $(".delete-msg-confirm").find(".spinner-border").addClass("d-none");
                $(".modal-msg .delete-msg-confirm").removeAttr("data-msg-id");
                $(".freshdesk-view-ticket.msg-"+ _msgID).remove();
                $(".modal-msg").modal("hide");
            }, 3000);
        });
    </script>
    <script>
        $('#reply-form').click(function(e) {
            e.preventDefault();

            var from_email = $('#from_email').val(),
                editor_msg = CKEDITOR.instances['msgText'].getData(),
                msg = editor_msg.replace(/<\/?p>/g, ''),
                to_email = $('#emailTo').val();

            $.ajax({
                url: $('#reply').attr('action'),
                type: 'POST',
                data: {
                    _token: {{ csrf_field() }},
                    from_email: from_email,
                    description: msg,
                    to_email: to_email
                },
                dataType: 'json',
                success: function(data) {
                    $('#msg-box').append(`
                        <div class="freshdesk-view-ticket msg-1">
                            <div class="ticket-view">
                                <div class="person-card">
                                    <div class="pic">
                                        <img src="assets/img/user-2.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="content">
                                        <h2 class="title">
                                            `+ data.reply.ticket.client.name +`
                                            <span class="ml-2">
                                                replied
                                            </span>
                                        </h2>
                                        <p class="date">

                                        </p>
                                    </div>
                                    <div class="option">
                                        <a href="#!" class="btn btn-icon btn-forward" data-msg-id="1" data-email="alaa@krunb4itcom" data-toggle="tooltip" title="forword">
                                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8111 6.31076C17.871 6.25038 17.9185 6.17865 17.9509 6.09969C17.9833 6.02072 18 5.93607 18 5.85057C18 5.76508 17.9833 5.68043 17.9509 5.60146C17.9185 5.5225 17.871 5.45077 17.8111 5.39039L12.6686 0.190613C12.5479 0.0685656 12.3842 -4.06662e-09 12.2135 0C12.0428 4.06662e-09 11.8791 0.0685656 11.7584 0.190613C11.6377 0.312661 11.5699 0.478192 11.5699 0.650794C11.5699 0.823395 11.6377 0.988927 11.7584 1.11097L15.8043 5.2006H3.21408C2.36165 5.2006 1.54414 5.543 0.941382 6.15247C0.338625 6.76193 0 7.58855 0 8.45047V18.85C0 19.0224 0.067725 19.1877 0.188276 19.3096C0.308828 19.4315 0.472331 19.5 0.642816 19.5C0.813302 19.5 0.976804 19.4315 1.09736 19.3096C1.21791 19.1877 1.28563 19.0224 1.28563 18.85V8.45047C1.28563 7.93331 1.48881 7.43735 1.85046 7.07166C2.21212 6.70598 2.70262 6.50055 3.21408 6.50055H15.8043L11.7584 10.5902C11.6377 10.7122 11.5699 10.8778 11.5699 11.0504C11.5699 11.223 11.6377 11.3885 11.7584 11.5105C11.8791 11.6326 12.0428 11.7011 12.2135 11.7011C12.3842 11.7011 12.5479 11.6326 12.6686 11.5105L17.8111 6.31076Z" fill="#3D3D3D"/>
                                            </svg>
                                        </a>
                                        <a href="#!" class="btn btn-icon danger btn-delete"  data-msg-id="1" data-email="alaa@krunb4itcom"  data-toggle="tooltip" title="delete">
                                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.38401 7.15039C5.56253 7.15039 5.73373 7.21887 5.85995 7.34077C5.98618 7.46267 6.05709 7.628 6.05709 7.80039V15.6004C6.05709 15.7728 5.98618 15.9381 5.85995 16.06C5.73373 16.1819 5.56253 16.2504 5.38401 16.2504C5.2055 16.2504 5.0343 16.1819 4.90808 16.06C4.78185 15.9381 4.71094 15.7728 4.71094 15.6004V7.80039C4.71094 7.628 4.78185 7.46267 4.90808 7.34077C5.0343 7.21887 5.2055 7.15039 5.38401 7.15039ZM8.7494 7.15039C8.92791 7.15039 9.09911 7.21887 9.22534 7.34077C9.35156 7.46267 9.42248 7.628 9.42248 7.80039V15.6004C9.42248 15.7728 9.35156 15.9381 9.22534 16.06C9.09911 16.1819 8.92791 16.2504 8.7494 16.2504C8.57089 16.2504 8.39969 16.1819 8.27346 16.06C8.14724 15.9381 8.07632 15.7728 8.07632 15.6004V7.80039C8.07632 7.628 8.14724 7.46267 8.27346 7.34077C8.39969 7.21887 8.57089 7.15039 8.7494 7.15039ZM12.7879 7.80039C12.7879 7.628 12.7169 7.46267 12.5907 7.34077C12.4645 7.21887 12.2933 7.15039 12.1148 7.15039C11.9363 7.15039 11.7651 7.21887 11.6388 7.34077C11.5126 7.46267 11.4417 7.628 11.4417 7.80039V15.6004C11.4417 15.7728 11.5126 15.9381 11.6388 16.06C11.7651 16.1819 11.9363 16.2504 12.1148 16.2504C12.2933 16.2504 12.4645 16.1819 12.5907 16.06C12.7169 15.9381 12.7879 15.7728 12.7879 15.6004V7.80039Z" fill="#EC5353"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 3.9C17.5 4.24478 17.3582 4.57544 17.1057 4.81924C16.8533 5.06304 16.5109 5.2 16.1538 5.2H15.4808V16.9C15.4808 17.5896 15.1971 18.2509 14.6922 18.7385C14.1873 19.2261 13.5025 19.5 12.7885 19.5H4.71154C3.99749 19.5 3.3127 19.2261 2.80779 18.7385C2.30288 18.2509 2.01923 17.5896 2.01923 16.9V5.2H1.34615C0.989132 5.2 0.646732 5.06304 0.394279 4.81924C0.141826 4.57544 0 4.24478 0 3.9V2.6C0 2.25522 0.141826 1.92456 0.394279 1.68076C0.646732 1.43696 0.989132 1.3 1.34615 1.3H6.05769C6.05769 0.955218 6.19952 0.624558 6.45197 0.380761C6.70442 0.136964 7.04682 0 7.40385 0L10.0962 0C10.4532 0 10.7956 0.136964 11.048 0.380761C11.3005 0.624558 11.4423 0.955218 11.4423 1.3H16.1538C16.5109 1.3 16.8533 1.43696 17.1057 1.68076C17.3582 1.92456 17.5 2.25522 17.5 2.6V3.9ZM3.52423 5.2L3.36538 5.2767V16.9C3.36538 17.2448 3.50721 17.5754 3.75966 17.8192C4.01212 18.063 4.35452 18.2 4.71154 18.2H12.7885C13.1455 18.2 13.4879 18.063 13.7403 17.8192C13.9928 17.5754 14.1346 17.2448 14.1346 16.9V5.2767L13.9758 5.2H3.52423ZM1.34615 3.9V2.6H16.1538V3.9H1.34615Z" fill="#EC5353"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="person-msg">
                                    <div class="icon">
                                        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 2.66667C0 1.95942 0.289731 1.28115 0.805456 0.781048C1.32118 0.280951 2.02065 0 2.75 0H19.25C19.9793 0 20.6788 0.280951 21.1945 0.781048C21.7103 1.28115 22 1.95942 22 2.66667V13.3333C22 14.0406 21.7103 14.7189 21.1945 15.219C20.6788 15.719 19.9793 16 19.25 16H2.75C2.02065 16 1.32118 15.719 0.805456 15.219C0.289731 14.7189 0 14.0406 0 13.3333V2.66667ZM2.75 1.33333C2.38533 1.33333 2.03559 1.47381 1.77773 1.72386C1.51987 1.97391 1.375 2.31304 1.375 2.66667V2.956L11 8.556L20.625 2.956V2.66667C20.625 2.31304 20.4801 1.97391 20.2223 1.72386C19.9644 1.47381 19.6147 1.33333 19.25 1.33333H2.75ZM20.625 4.51067L14.1515 8.27733L20.625 12.14V4.51067ZM20.5782 13.6787L12.8232 9.05067L11 10.1107L9.17675 9.05067L1.42175 13.6773C1.49989 13.9611 1.67244 14.2118 1.91261 14.3907C2.15279 14.5696 2.44715 14.6666 2.75 14.6667H19.25C19.5527 14.6667 19.8469 14.5699 20.087 14.3913C20.3272 14.2126 20.4999 13.9621 20.5782 13.6787ZM1.375 12.14L7.8485 8.27733L1.375 4.51067V12.14Z" fill="#3D3D3D"/>
                                        </svg>
                                    </div>
                                    <div class="info">
                                        <div class="to">
                                            <strong> to: </strong>`+
                                            data.reply.to_email
                                            +`
                                        </div>
                                        <div class="text">
                                            <h6>`+
                                                data.reply.description
                                            +`</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                    msg = '';
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })
    </script>

    <script>
        $('#group_id').change(function(e) {
            e.preventDefault();

            group_id = $(this).val();

            $.ajax({
                url: '/api/get-agent/'+group_id+'/',
                type: 'GET',
                data: {
                    id: group_id,
                },
                success: function(data) {
                    $('#agent').empty()
                    $.each(data.data, function(key_one, value_one) {

                        $('#agent').append(`
                            <option value="`+ value_one.contact.email +`" name="agent_id" >`+ value_one.contact.name +`</option>
                        `)
                    });
                },
                error: function (data) {
                    console.log(data);
                },
            });
        })
    </script>


    <script>
        $('#forward').click(function() {
            $('#user_contact').removeClass('d-none');
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#users').select2({
            ajax: {
                url: '{{ route('ticket.select') }}',
                dataType: 'json',
                delay: 250,
                type: 'get',
                data: function(term) {
                    return {
                        term: term.term,
                    };
                },
                processResults: function(response) {
                    console.log(response)
                    if (response) {
                        return {
                            results: response
                        };
                    }
                },
                cache: true
            }
        });
    </script>
    <script>
        $('#forward').click(function (){
            $('#users-select').removeClass('d-none');
        })
    </script>
    <script>
        $('#users').change(function (e) {
            id = $(this).val();

            $.ajax({

            })
        });
    </script>
@endsection
