<!-- ########## begin::Aside menu ########## -->
@php

    $user_type = '';
    if(Auth::guard('admin')->check())
        $user_type = 'admin';
    elseif(Auth::guard('employee')->check())
        $user_type = 'employee';
    elseif(Auth::guard('driver')->check())
        $user_type = 'driver';
    elseif(Auth::guard('user')->check())
        $user_type = 'user';

    $shippments_viewed = App\Models\ShippmentView::where('user_id', Auth::id())->where('user_type', $user_type)->pluck('shippment_id');

    if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
        $shippments_count = App\Models\Shippment::whereNotIn('id', $shippments_viewed)->count();
    } else if(Auth::guard('user')->check()) {
        $shippments_count = App\Models\Shippment::whereNotIn('id', $shippments_viewed)
        ->where('user_id', Auth::id())
        ->count();
    } else if(Auth::guard('driver')->check()) {
        $shippments_ids_of_drivers = App\Models\Delivery::where('driver_id', Auth::id())->pluck('shippment_id');
        $shippments_count = App\Models\Shippment::whereNotIn('id', $shippments_viewed)
        ->whereIn('id', $shippments_ids_of_drivers)
        ->count();
    }
@endphp
<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <div class="menu-content pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                </div>
            </div>
            <div class="menu-item">
                <a class="menu-link @if(activeRoute('app')) active @endif" href="{{route('app')}}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">{{__('site.dashboard')}}</span>
                </a>
                @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                    <a class="menu-link @if(activeRoute('dashboard.sitting')) active @endif" href="{{route('dashboard.sitting')}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{__('site.account')}}</span>
                    </a>
                    @can('cities.index')
                        <a class="menu-link @if(activeRoute('city.index')) active @endif" href="{{route('city.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.zones')}}</span>
                        </a>
                    @endcan
                    @can('shippments.index')
                        <a class="menu-link @if(activeRoute('getshipment')) active @endif" href="{{route('getshipment')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.all-shippment')}}</span>
                            <span class="badge badge-secondary d-block font-weight-bold">{{ $shippments_count }}</span>
                        </a>
                    @endcan
                    @can('assigned_pickups.index')
                        <a class="menu-link @if(activeRoute('assignedpickup.index')) active @endif" href="{{route('assignedpickup.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.all-pickup')}}</span>
                        </a>
                    @endcan
                    @can('roles.index')
                        <a class="menu-link @if(activeRoute('roles.index')) active @endif" href="{{route('roles.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.role')}}</span>
                        </a>
                    @endcan
                    @can('accounts_seller.index')
                        <a class="menu-link @if(activeRoute('account.index')) active @endif" href="{{route('account.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.accountseller')}}</span>
                        </a>
                    @endcan
                    @can('accounts_driver.index')
                        <a class="menu-link @if(activeRoute('shipments_drivers')) active @endif" href="{{route('shipments_drivers')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.accountdriver')}}</span>
                        </a>
                    @endcan
                @endif
            </div>



            {{-- ======================== HR ========================= --}}
            @if(Auth::user()->can('sellers.index') || Auth::user()->can('drivers.index') || Auth::user()->can('employees.index'))
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-0">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">HR</span>
                    </div>
                </div>
            @endif
            @can('sellers.index')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                @if(activeRoute([
                    'user.index',
                    'user.create',
                ]))
                hover show
                @endif
                ">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                        fill="black" />
                                    <path opacity="0.3"
                                        d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{__('site.seller')}}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        @can('sellers.index')
                            <div class="menu-item">
                                <a class="menu-link @if(activeRoute('user.index')) active @endif" href="{{route('user.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.seller_list')}}</span>
                                </a>
                            </div>
                        @endcan
                        @can('sellers.create')
                            <div class="menu-item">
                                <a class="menu-link @if(activeRoute('user.create')) active @endif" href="{{route('user.create')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.add_seller')}}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endcan
            @can('drivers.index')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                @if(activeRoute([
                    'driver.index',
                    'driver.create',
                ]))
                hover show
                @endif
                ">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                        fill="black" />
                                    <path opacity="0.3"
                                        d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{__('site.driver')}}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        @can('drivers.index')
                            <div class="menu-item">
                                <a class="menu-link @if(activeRoute('driver.index')) active @endif" href="{{route('driver.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.driver_list')}}</span>
                                </a>
                            </div>
                        @endcan
                        @can('drivers.create')
                            <div class="menu-item">
                                <a class="menu-link @if(activeRoute('driver.create')) active @endif" href="{{route('driver.create')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.add_driver')}}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endcan
            @can('employees.index')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                @if(activeRoute([
                    'employee.index',
                    'employee.create',
                ]))
                hover show
                @endif
                ">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                        fill="black" />
                                    <path opacity="0.3"
                                        d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{__('site.employee')}}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        @can('employees.index')
                            <div class="menu-item">
                                <a class="menu-link @if(activeRoute('employee.index')) active @endif" href="{{route('employee.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.employee_list')}}</span>
                                </a>
                            </div>
                        @endcan
                        @can('employees.create')
                            <div class="menu-item">
                                <a class="menu-link @if(activeRoute('employee.create')) active @endif" href="{{route('employee.create')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.add_employee')}}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endcan

            {{-- ======================== end HR ========================= --}}


            @if(Auth::guard('user')->check())
                {{-- ======================== seller ========================= --}}

                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-0">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{__('site.seller')}}</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link @if(activeRoute('account.user')) active @endif" href="{{route('account.user')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.account')}}</span>
                        </a>
                    </div>
                    @can('shippments.index')
                        <div class="menu-item">
                            <a class="menu-link @if(activeRoute('shipment.index')) active @endif" href="{{route('shipment.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.shipment')}}</span>
                                <span class="badge badge-secondary font-weight-bold">{{ $shippments_count }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('assigned_pickups.index')
                        <div class="menu-item">
                            <a class="menu-link @if(activeRoute('pickup.index')) active @endif" href="{{route('pickup.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.pickup')}}</span>
                            </a>
                        </div>
                    @endcan
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-0">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">Export</span>
                        </div>
                    </div>
                    @can('accounts_seller.index')
                        <div class="menu-item">
                            <a class="menu-link @if(activeRoute('account.index')) active @endif" href="{{route('account.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.accountseller')}}</span>
                            </a>
                        </div>
                    @endcan

                {{-- ======================== *end seller* ========================= --}}
            @endif

            @if(Auth::guard('driver')->check())
                {{-- ======================== driver ========================= --}}
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-0">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{__('site.driver')}}</span>
                        </div>
                    </div>
                    @can('assigned_pickups.index')
                        <div class="menu-item">
                            <a class="menu-link @if(activeRoute('driver.pickups')) active @endif" href="{{route('driver.pickups')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.pickups')}}</span>
                            </a>
                        </div>
                    @endcan
                    @can('shippments.index')
                        <div class="menu-item">
                            <a class="menu-link @if(activeRoute('driver.shippments')) active @endif" href="{{route('driver.shippments')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.shippments')}}</span>
                                <span class="badge badge-secondary font-weight-bold">{{ $shippments_count }}</span>
                            </a>
                        </div>
                    @endcan
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-0">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">Export</span>
                        </div>
                    </div>
                    @can('accounts_driver.index')
                        <div class="menu-item">
                            <a class="menu-link @if(activeRoute('shipments_drivers')) active @endif" href="{{route('shipments_drivers')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.accountdriver')}}</span>
                            </a>
                        </div>
                    @endcan
                    {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('site.pages') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/layouts/toolbars/toolbar-2.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Toolbar 2</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/layouts/toolbars/toolbar-3.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Toolbar 3</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/layouts/toolbars/toolbar-4.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Toolbar 4</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/layouts/toolbars/toolbar-5.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Toolbar 5</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                {{-- ======================== *end driver*========================= --}}
            @endif

            {{-- <div class="menu-item">
                <div class="menu-content">
                    <div class="separator mx-1 my-4"></div>
                </div>
            </div> --}}

            {{-- <div class="menu-item">
                <a class="menu-link" href="../../demo1/dist/documentation/getting-started/changelog.html">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z"
                                    fill="black" />
                                <path opacity="0.3"
                                    d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Changelog v8.0.24</span>
                </a>
            </div> --}}

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
<!-- ########## end::Aside menu ########## -->
