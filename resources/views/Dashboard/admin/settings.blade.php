@extends('Dashboard.app')

@section('title',__('site.details'))

@section('page_name',__('site.details'))


@section('pages')

<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('app')}}" class="text-muted text-hover-primary">{{__('site.home')}}</a>
    </li>
    <!--end::Item-->

</ul>

@endsection
@section('css')

@endsection

@section('content')


<div class="d-flex flex-column flex-xl-row">

    <div class="flex-lg-row-fluid">

        <div class="card mb-5 mb-xl-8">

            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"
                        role="button" aria-expanded="false" aria-controls="kt_user_view_details">{{ __('site.details') }}
                        <span class="ms-2 rotate-180">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>

                </div>
                <!--end::Details toggle-->
                <div class="separator"></div>
                <!--begin::Details content-->
                <div id="kt_user_view_details" class="collapse show">
                    <div class="pb-5 fs-6">

                        <form id="kt_account_profile_details_form" method="POST" action="{{ route('dashboard.sitting.update') }}" class="form" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input img-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('site.avatar') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"

                                            style="background-image: url(/assets/media/avatars/blank.png)
                                            ">

                                            <!--begin::Preview existing avatar-->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                    style="background-image:
                                                    @if(Auth::user()->avatar)url(/{{ Auth::user()->avatar }})@else url(/assets/media/avatars/150-26.jpg)@endif"></div>
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Cancel-->
                                            <!--begin::Remove-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Remove-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <!--end::Input img-->

                                <!--begin::Input Name-->
                                <div class="row mb-12">
                                    <!--begin::Label-->
                                    <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.name')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-12 fv-row">
                                        <input type="text" name="name"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{auth()->user()->name}}" />
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input Name-->

                                <!--begin::email && phone-->
                                <div class="row mb-6">

                                    <!--begin::Col-->
                                    <div class="col-lg-12">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::email-->
                                            <div class="col-lg-6 fv-row">
                                                <label
                                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.email')}}</label>
                                                <input type="email" id="email" disabled
                                                    value="{{auth()->user()->email}}"
                                                    class="form-control form-control-lg form-control-solid">
                                            </div>
                                            <!--end::email-->

                                            <!--begin::phone-->
                                            <div class="col-lg-6 fv-row">
                                                <label
                                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.phone')}}</label>
                                                <input type="text" id="phone" name="phone"
                                                    value="{{auth()->user()->phone}}"
                                                    class="form-control form-control-lg form-control-solid">
                                                    @error('phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <!--end::phone-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::email && phone-->

                                <!--begin::Input old_password-->
                                <div class="row mb-12">
                                    <!--begin::Label-->
                                    <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.old_password.name')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-12 fv-row">
                                        <input type="password" name="old_password"
                                            class="form-control form-control-lg form-control-solid" />
                                        @error('old_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @if(Session::has('old_password.invalid'))
                                            <h6 class="text-danger">{{ Session::get('old_password.invalid') }}</h6>
                                        @endif
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input old_password-->

                                <!--begin::Input password-->
                                <div class="row mb-12">
                                    <!--begin::Label-->
                                    <label class="">{{__('site.new_password')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-12 fv-row">
                                        <input type="password" name="password"
                                            class="form-control form-control-lg form-control-solid" value="" />
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input password-->

                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-2 px-6">
                                <button type="submit" class="btn btn-primary"
                                    id="kt_account_profile_details_submit">{{__('site.save_changes')}}</button>
                            </div>
                            <!--end::Actions-->
                        </form>


                    </div>
                </div>
                <!--end::Details content-->
            </div>
            <!--end::Card body-->

        </div>

    </div>

</div>

@endsection

@section('js')
    <script>

    </script>
@endsection
