<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow pt-0">
            <li class="m-menu__item  m-menu__item--submenu ">
                <a  class="m-menu__link m-menu__toggle text-white">Main</a>
            </li>

            <li class="m-menu__item  @if(\Request::route()->getName() == 'admin.dashboard.view') m-menu__item--active @endif" aria-haspopup="true">
                <a href="/admin/dashboard" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('lang.dashboard')}}</span>
                        </span>
                    </span>
                </a>
            </li>

            <li class="m-menu__item  m-menu__item--submenu ">
                <a  class="m-menu__link m-menu__toggle text-white">Systems</a>
            </li>

            @can('products')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.products.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.products.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-award"></i>
                        <span class="m-menu__link-text">{{trans('lang.products')}}</span>
                    </a>
                </li>
            @endcan

            @can('clients')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.clients.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.clients.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-users"></i>
                        <span class="m-menu__link-text">{{trans('lang.companies')}}</span>
                    </a>
                </li>
            @endcan

            @can('renewal_team')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.renewal-team.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.renewal-team.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-users"></i>
                        <span class="m-menu__link-text">{{trans('lang.renewal-team')}}</span>
                    </a>
                </li>

            @endcan

            @can('licenses')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.licenses.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.licenses.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-id-badge"></i>
                        <span class="m-menu__link-text">{{trans('lang.licenses')}}</span>
                    </a>
                </li>
            @endcan

            @can('activations')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.activations.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.activations.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-check-double"></i>
                        <span class="m-menu__link-text">{{trans('lang.activations')}}</span>
                    </a>
                </li>
            @endcan

            @can('api_calls')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.api-calls.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.api-calls.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-check-double"></i>
                        <span class="m-menu__link-text">{{trans('lang.api_calls')}}</span>
                    </a>
                </li>
            @endcan

            @can('downloads')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.downloads.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.downloads.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-download"></i>
                        <span class="m-menu__link-text">{{trans('lang.downloads')}}</span>
                    </a>
                </li>
            @endcan

            @can('notifications')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.notifications.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.notifications.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-bell"></i>
                        <span class="m-menu__link-text">{{trans('lang.notifications')}}</span>
                    </a>
                </li>
            @endcan

            @can('roles')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.roles.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.roles.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-users"></i>
                        <span class="m-menu__link-text">{{trans('lang.roles')}}</span>
                    </a>
                </li>
            @endcan

            @can('users')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.users.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.users.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-users"></i>
                        <span class="m-menu__link-text">{{trans('lang.admins')}}</span>
                    </a>
                </li>
            @endcan
            @can('contactus')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.contact-us.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.contact-us.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fab fa-telegram"></i>
                        <span class="m-menu__link-text">{{trans('lang.contact_us')}}</span>
                    </a>
                </li>
            @endcan


            @if(Auth::user()->can('setting') or Auth::user()->can('cities') or Auth::user()->can('countries') or Auth::user()->can('email_setings') or Auth::user()->can('get_api_key'))
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.setting.index' or \Request::route()->getName() == 'admin.setting.api_setting'  || \Request::route()->getName() == 'admin.setting.account' || \Request::route()->getName() == 'admin.countries.index' || \Request::route()->getName() == 'admin.cities.index') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-layer-group"></i>
                        <span class="m-menu__link-text">{{trans('lang.setting')}}</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu " m-hidden-height="840">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">{{trans('lang.setting')}}</span>
                            </span>
                            </li>
                            @can('countries')
                                <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'admin.countries.index') m-menu__item--active @endif" aria-haspopup="true">
                                    <a href="{{route('admin.countries.index')}}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">{{ucwords(trans('lang.countries'))}}</span>
                                    </a>
                                </li>

                            @endcan
                            @can('cities')
                                <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'admin.cities.index') m-menu__item--active @endif" aria-haspopup="true">
                                    <a href="{{route('admin.cities.index')}}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">{{ucwords(trans('lang.cities'))}}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting')
                                <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'admin.setting.index') m-menu__item--active @endif" aria-haspopup="true">
                                    <a href="{{route('admin.setting.index')}}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">{{trans('lang.general_settings')}}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting')
                                <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'admin.setting.api_setting') m-menu__item--active @endif" aria-haspopup="true">
                                    <a href="{{route('admin.setting.api_setting')}}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">{{trans('lang.api_settings')}}</span>
                                    </a>
                                </li>
                            @endcan

                            {{-- @can('email_setings')
                            <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'admin.setting.email_setting') m-menu__item--active @endif" aria-haspopup="true">
                                <a href="{{route('admin.setting.email_setting')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">{{trans('lang.email_settings')}}</span>
                                </a>
                            </li>
                            @endcan --}}
                            <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'admin.setting.account') m-menu__item--active @endif" aria-haspopup="true">
                                <a href="{{route('admin.setting.account')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">{{trans('lang.account_settings')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif








            <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'tag.index' or \Request::route()->getName() == 'type.index' or \Request::route()->getName() == 'status.index' or \Request::route()->getName() == 'priotary.index' or \Request::route()->getName() == 'ticket.index') m-menu__item--open @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon fas fa-layer-group"></i>
                    <span class="m-menu__link-text">{{trans('lang.tickets_page')}}</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " m-hidden-height="840">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">{{trans('lang.tickets_page')}}</span>
                            </span>
                        </li>
                        {{--                            @can('countries')--}}

                        <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'ticket.index') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{ route('ticket.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{ucwords(trans('lang.tickets_page'))}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'tag.index') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('tag.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{ucwords(trans('lang.tags'))}}</span>
                            </a>
                        </li>

                        <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'type.index') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('type.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{ucwords(trans('lang.type'))}}</span>
                            </a>
                        </li>


                        <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'status.index') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('status.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{ucwords(trans('lang.status'))}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu @if(\Request::route()->getName() == 'priotary.index') m-menu__item--active @endif" aria-haspopup="true">
                            <a href="{{route('priotary.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{ucwords(trans('lang.priotary'))}}</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>


            <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'group.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="{{ route('group.index') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon fas fa-users"></i>
                    <span class="m-menu__link-text">
                        {{ trans('lang.group_page') }}
                    </span>
                </a>
            </li>


            @can('activity_logs')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.activity_logs.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.activity_logs.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-bell"></i>
                        <span class="m-menu__link-text">{{trans('lang.activity_logs')}}</span>
                    </a>
                </li>
            @endcan

            @can('static_page')
                <li class="m-menu__item  m-menu__item--submenu @if(\Request::route()->getName() == 'admin.static_page.index') m-menu__item--active @endif" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="{{route('admin.static_page.index')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-file"></i>
                        <span class="m-menu__link-text">{{trans('lang.static_page')}}</span>
                    </a>
                </li>
            @endcan



        </ul>
    </div>

    <!-- END: Aside Menu -->
</div>
