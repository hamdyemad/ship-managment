<!-- ########## begin::Aside menu ########## -->
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
                <a class="menu-link active" href="{{route('app')}}">
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
            </div>

            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Crafted</span>
                </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                    fill="black" />
                                <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                    fill="black" />
                                <path opacity="0.3"
                                    d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Pages</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    {{-- ========== profile ========== --}}
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Color-profile.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <circle fill="#000000" cx="12" cy="9" r="5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="menu-title">Profile</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('dashboard.sitting')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.account')}}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('city.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.zones')}}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/profile/campaigns.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.export-shippment')}}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/profile/documents.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.export-drivers')}}</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    {{-- ========== end profile ========== --}}

                    {{-- ========== user ========== --}}
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{__('site.user')}}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('account.user')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.account')}}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('shipment.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.shipment')}}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('pickup.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{__('site.pickup')}}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/projects/budget.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Budget</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/projects/users.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Users</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/projects/files.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Files</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/projects/activity.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Activity</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/projects/settings.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Settings</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- ========== end user ========== --}}

                    {{-- ========== seller ========== --}}
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Seller</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('user.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Seller List</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('user.create')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Seller</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- ========== end seller ========== --}}

                    {{-- ========== Driver ========== --}}
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Driver</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('driver.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">driver List</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('driver.create')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Driver</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- ========== end Driver ========== --}}

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Blog</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/blog/home.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Blog Home</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/blog/post.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Blog Post</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Company</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/company/about.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">About Us</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/company/pricing.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pricing</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/company/contact.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Contact Us</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/company/team.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Our Team</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/company/licenses.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Licenses</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/company/sitemap.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Sitemap</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Careers</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/careers/list.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Careers List</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/careers/apply.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Careers Apply</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">FAQ</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/faq/classic.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Classic</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="../../demo1/dist/pages/faq/extended.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Extended</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <div class="menu-content">
                    <div class="separator mx-1 my-4"></div>
                </div>
            </div>

            <div class="menu-item">
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
            </div>

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
<!-- ########## end::Aside menu ########## -->
