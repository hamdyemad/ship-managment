@extends('Dashboard.app')

@section('title',__('site.edit'))

@section('page_name',__('site.edit'))


@section('pages')

<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('app')}}" class="text-muted text-hover-primary">{{__('site.home')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('user.index')}}" class="text-muted text-hover-primary">{{__('site.driver')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="" class="text-muted text-hover-primary">{{__('site.edit')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->

    <li class="breadcrumb-item text-muted">
        <a href="" class="text-muted text-hover-primary">{{$driver->name}}</a>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')

@endsection

@section('content')

<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('site.driver')}}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">

                <!--begin::name-->
                <div class="row mb-12">
                    <!--begin::Col-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.name')}}</label>
                    <input type="text" id="name" name="name" value="{{$driver->name}}"
                        class="form-control form-control-lg form-control-solid">

                </div>
                <!--end::name-->

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
                                <input type="text" id="email" name="email" value="{{$driver->email}}"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::email-->

                            <!--begin::phone-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.phone')}}</label>
                                <input type="text" id="phone" name="phone" value="{{$driver->phone}}"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::phone-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::email && phone-->

                <!--begin::Input password-->
                <div class="row mb-12">
                    <!--begin::Label-->
                    <label class="">{{__('site.password')}}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-12 fv-row">
                        <input type="password" id="password" name="password"
                            class="form-control form-control-lg form-control-solid">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input password-->

                <!--begin::Input password_confirmation-->
                <div class="row mb-12">
                    <!--begin::Label-->
                    <label class="">{{__('site.password_confirmation')}}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-12 fv-row">
                        <input type="password" name="password_confirmation"
                            class="form-control form-control-lg form-control-solid">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input password_confirmation-->

                <!--begin::price of pickup-->

                <div class="row">


                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            <label class="col-lg-12 col-form-label fw-bold fs-6">{{__('site.pickup_price')}} <p
                                    style="font-size: 10px;color: rgb(160, 151, 151)">
                                    ({{__('site.optional')}})</p></label>
                            <input type="number" name="special_pickup" id="special_pickup" placeholder=""
                                class="form-control form-control-sm form-control-solid">


                        </div>

                    </div>

                </div>
                <!--end::price of pickup-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="updatedriver()" class="btn btn-primary"
                    id="kt_account_profile_details_submit">
                    {{__('site.update')}}
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

@endsection

@section('js')

<script>
    //update seller (user) in the system

        function updatedriver() {
            axios.put('/dashboard/driver/{{$driver->id}}', {

                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                password: document.getElementById('password').value,
                special_pickup: document.getElementById('special_pickup').value,
            })
            .then(function (response) {
                //2xx
                console.log(response);
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500
                });
                document.getElementById('kt_account_profile_details_form').reset();
                window.location.href = "/dashboard/driver";

            })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: error.response.data.message,
                showConfirmButton: false,
                timer: 1500
                });

            });
        }


</script>

@endsection
