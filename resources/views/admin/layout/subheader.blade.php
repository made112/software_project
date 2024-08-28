			<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">

						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-dark ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="{{URL::to('/')}}/admin/dashboard" class="m-brand__logo-wrapper">
										@if($site_setting)
                                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 159.3 52.91" width="120"><defs><style>.cls-1{fill:#f2f2f2;}.cls-2{fill:#62f3cb;}.cls-3{fill:#f34d68;}.cls-4{fill:#c769f9;}.cls-5{fill:#2390f5;}.cls-6{fill:#ffe164;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M131.05,45h-1.81l-3.54,7.93h1.88l.7-1.7h0l.58-1.39h0l1.26-3h0l2.55,6.12h1.91Z"/><path class="cls-1" d="M155,51.44V49.6h3.69V48.17h-5.51v4.75h6.14V51.44Zm0-5h4.32V45h-6.14v1.47Z"/><polygon class="cls-1" points="118.85 44.98 116.92 50.35 115.03 44.98 113.08 44.98 113.08 44.99 115.81 52.91 118.01 52.91 120.89 44.98 118.85 44.98"/><polygon class="cls-1" points="111.04 44.98 108.87 44.98 111.74 52.91 113.79 52.91 112.26 48.48 111.04 44.98"/><path class="cls-1" d="M85.39,45v1.46h6V45Zm0,7.93h1.83V50H90.9V48.55H85.39Z"/><path class="cls-1" d="M75.47,45v1.51A2.46,2.46,0,1,1,73.06,49H71.27a4.2,4.2,0,1,0,4.2-4Z"/><path class="cls-1" d="M145.65,50.36a2.57,2.57,0,0,0,1.3-1.12,2.79,2.79,0,0,0,.34-1.38,2.94,2.94,0,0,0-.33-1.39A3.33,3.33,0,0,0,143.84,45H140.4v1.49h3.34c1.12,0,1.69.51,1.69,1.39s-.57,1.38-1.69,1.38H140.4v3.67h1.84V50.7h1.69l1.53,2.21h2Z"/><path class="cls-1" d="M59.16,52l.61-1.34a4.5,4.5,0,0,0,2.53.8c1.05,0,1.48-.35,1.48-.82,0-1.44-4.46-.45-4.46-3.3,0-1.31,1-2.39,3.23-2.39a5.13,5.13,0,0,1,2.66.68L64.67,47a4.42,4.42,0,0,0-2.13-.6c-1,0-1.46.4-1.46.88,0,1.41,4.46.44,4.46,3.26,0,1.28-1.06,2.37-3.25,2.37A5.53,5.53,0,0,1,59.16,52Z"/><path class="cls-1" d="M99.65,46.47H97.11V45H104v1.49h-2.54v6.44H99.65Z"/><rect class="cls-2" x="23.74" y="23.72" width="5.27" height="5.27" rx="0.18"/><rect class="cls-3" x="15.84" y="23.72" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="32.1" y="23.72" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="15.84" y="15.81" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="7.91" y="15.81" width="5.27" height="5.27" rx="0.18"/><rect class="cls-3" x="7.93" y="7.91" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" y="7.91" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="7.93" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" width="5.27" height="5.27" rx="0.18"/><rect class="cls-4" x="47.94" y="7.91" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="40.01" y="7.91" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="47.94" width="5.27" height="5.27" rx="0.18"/><rect class="cls-5" x="40.01" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="40.03" y="15.81" width="5.27" height="5.27" rx="0.18"/><rect class="cls-3" x="32.1" y="15.81" width="5.27" height="5.27" rx="0.18"/><rect class="cls-2" x="32.1" y="31.63" width="5.27" height="5.27" rx="0.18" transform="translate(69.47 68.53) rotate(180)"/><rect class="cls-3" x="40.03" y="31.63" width="5.27" height="5.27" rx="0.18" transform="translate(85.33 68.53) rotate(180)"/><rect class="cls-2" x="40.01" y="39.54" width="5.27" height="5.27" rx="0.18" transform="translate(85.29 84.34) rotate(180)"/><rect class="cls-6" x="47.94" y="39.54" width="5.27" height="5.27" rx="0.18" transform="translate(101.14 84.34) rotate(180)"/><rect class="cls-2" x="40.01" y="47.44" width="5.27" height="5.27" rx="0.18" transform="translate(85.29 100.16) rotate(180)"/><rect class="cls-2" x="47.94" y="47.44" width="5.27" height="5.27" rx="0.18" transform="translate(101.14 100.16) rotate(180)"/><rect class="cls-5" y="39.54" width="5.27" height="5.27" rx="0.18" transform="translate(5.27 84.34) rotate(180)"/><rect class="cls-4" x="7.93" y="39.54" width="5.27" height="5.27" rx="0.18" transform="translate(21.13 84.34) rotate(180)"/><rect class="cls-2" y="47.44" width="5.27" height="5.27" rx="0.18" transform="translate(5.27 100.16) rotate(180)"/><rect class="cls-2" x="7.93" y="47.44" width="5.27" height="5.27" rx="0.18" transform="translate(21.13 100.16) rotate(180)"/><rect class="cls-6" x="7.91" y="31.63" width="5.27" height="5.27" rx="0.18" transform="translate(21.09 68.53) rotate(180)"/><rect class="cls-2" x="15.84" y="31.63" width="5.27" height="5.27" rx="0.18" transform="translate(36.94 68.53) rotate(180)"/></g></g></svg>
                                        @endif
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">

									<!-- BEGIN: Left Aside Minimize Toggle -->
									<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>

									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>

						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
							<!-- BEGIN: Horizontal Menu -->
							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
								<i class="la la-close"></i>
							</button>
							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
								<ul class="m-menu__nav  m-menu__nav--submenu-arrow submenu_logo">
									<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel font-weight-bold" style="font-size: 14px" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
										@if($site_setting)
										<img alt="" src="/admin-assets/assets/cyberx.png" style="width:140px"/>
										@endif
									</li>
								</ul>
							</div>

							<!-- END: Horizontal Menu -->

							<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
							               @php

                                            $str = strip_tags(\Auth::user()->name);

                                            $str = trim($str);

                                            if (strlen($str) > 19) {

                                              $str = substr($str, 0, 17);

                                              $str .= (true) ? '..' : '';

                                            }

                                          @endphp
									    <li class="m-nav__item " style="line-height: 65px;">
									              <b>  {{trans('lang.welcome_back')}} <span data-toggle="tooltip" data-placement="top" title="{{Auth::user()->name}}" style="color: #eb3557;cursor: pointer;

                                                  ">{{$str}} </b>

                                                  </span> ، <a href="{{ route('admin.dashboard.logout') }}" data-toggle="tooltip" title="{{trans('lang.logout')}}" data-placement="top" class="btn btn-info ml-2 btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
													<i class="fas fa-sign-out-alt"></i>
												</a>

                                                 <form id="logout-form" action="{{ route('admin.dashboard.logout') }}" method="get" style="display: none;"></form>
									    </li>
										<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
											<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
												<span class="m-nav__link-icon">
													<i class="flaticon-alarm"></i>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(/admin-assets/assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">
														<span class="m-dropdown__header-title">{{trans('lang.notifications')}}</span>
														<span class="m-dropdown__header-subtitle"></span>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">

															</ul>
															<div class="tab-content">
																<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
																	<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
																		<div class="m-list-timeline m-list-timeline--skin-light">
																			<div class="m-list-timeline__items">

																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>

									</ul>
								</div>
							</div>

							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>

			<!-- END: Header -->
