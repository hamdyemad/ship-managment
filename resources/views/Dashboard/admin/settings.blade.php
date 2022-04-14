@extends('Dashboard.app')

@section('page-name')


@section('pages')


@section('css')

@endsection

@section('content')

<!--begin::Layout-->
<div class="d-flex flex-column flex-xl-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">

            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"
                        role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
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

                        <form id="kt_account_profile_details_form" class="form">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input img-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url(assets/media/avatars/blank.png)">
                                            <!--begin::Preview existing avatar-->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url(assets/media/avatars/150-26.jpg)"></div>
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
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="">{{__('site.name')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10 fv-row">
                                        <input type="text" name="name"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{auth()->user()->name}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input Name-->

                                <!--begin::Input Email-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="">{{__('site.email')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10 fv-row">
                                        <input type="email" name="email"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{auth()->user()->email}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input Email-->

                                <!--begin::Input phone-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="">
                                        <span class="required">{{__('site.phone')}}</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="Phone number must be active"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10 fv-row">
                                        <input type="string" name="phone"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{auth()->user()->phone}}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input phone-->

                                <!--begin::Input password-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="">{{__('site.password')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10 fv-row">
                                        <input type="password" name="password"
                                            class="form-control form-control-lg form-control-solid" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input password-->

                                <!--begin::Input password_confirmation-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="">{{__('site.password_confirmation')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10 fv-row">
                                        <input type="password" name="password_confirmation"
                                            class="form-control form-control-lg form-control-solid" value="" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input password_confirmation-->


                                <!--begin::Input group-->
                                <div class="row mb-0">
                                    <!--begin::Label-->
                                    <label class="">Allow Marketing</label>
                                    <!--begin::Label-->
                                    <!--begin::Label-->
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch fv-row">
                                            <input class="form-check-input w-45px h-30px" type="checkbox"
                                                id="allowmarketing" checked="checked" />
                                            <label class="form-check-label" for="allowmarketing"></label>
                                        </div>
                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

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
        <!--end::Card-->


    </div>
    <!--end::Sidebar-->

    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">

        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">

                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">

                    </div>
                    <!--end::Card header-->
                </div>
                <!--end::Card-->


            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->

</div>
<!--end::Layout-->


@endsection

@section('js')

@endsection
