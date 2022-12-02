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
        <a href="{{route('user.index')}}" class="text-muted text-hover-primary">{{__('site.user')}}</a>
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
        <a href="" class="text-muted text-hover-primary">{{$user->name}}</a>
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
            <h3 class="fw-bolder m-0">{{__('site.Seller')}}</h3>
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

                <!--begin::role-->
                <div class="row mb-12">
                    <!--begin::Col-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.role')}}</label>
                    <select class="form-control form-control-lg form-control-solid" id="role_id">
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::role-->


                <!--begin::name-->
                <div class="row mb-12">
                    <!--begin::Col-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.name')}}</label>
                    <input type="text" id="name" name="name" value="{{$user->name}}"
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
                                <div class="input-group mb-3">
                                    <input type="text" id="email" name="email" value="{{
                                        $res = str_replace( array('@' , 'shipexeg' , '.' , 'com' ), ''
                                        , $user->email); }}" class="form-control form-control-lg form-control-solid"
                                        aria-describedby="basic-addon2">

                                    <span class="input-group-text" id="basic-addon2">@shipexeg.com</span>
                                </div>
                            </div>
                            <!--end::email-->

                            <!--begin::phone-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.phone')}}</label>
                                <input type="text" id="phone" name="phone" value="{{$user->phone}}"
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
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.password')}}</label>
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
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.password_confirmation')}}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-12 fv-row">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control form-control-lg form-control-solid">
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input password_confirmation-->

                <!--begin::price of pickup-->
                <div class="row mb-12">


                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            <label class="col-lg-12 col-form-label fw-bold fs-6">{{__('site.pickup_price')}} <p
                                    style="font-size: 10px;color: rgb(160, 151, 151)">
                                    ({{__('site.optional')}})</p></label>
                            <input type="number" name="special_pickup" id="special_pickup"
                                value="{{$user->special_pickup}}" placeholder=""
                                class="form-control form-control-sm form-control-solid">


                        </div>

                    </div>

                </div>
                <!--end::price of pickup-->
                <!--begin::Input balance-->
                {{-- <div class="row">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{__('site.balance')}}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-12 fv-row">
                        <input type="number" value="{{ $user->balance }}" name="balance" id="balance"
                            class="form-control form-control-lg form-control-solid">
                    </div>
                    <!--end::Col-->
                </div> --}}
                <!--end::Input balance-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="updateseller()" class="btn btn-primary"
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

        function updateseller() {
            axios.put('/dashboard/user/{{$user->id}}', {

                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
                // balance: document.getElementById('balance').value,
                role_id: document.getElementById('role_id').value,
                special_pickup: document.getElementById('special_pickup').value,
                address_line: document.getElementById('address_line').value,
                city: document.getElementById('city').value,
                area: document.getElementById('area').value,
                building: document.getElementById('building').value,
                floor: document.getElementById('floor').value,
                apartment: document.getElementById('apartment').value,
                contact_name: document.getElementById('contact_name').value,
                contact_mobile: document.getElementById('contact_mobile').value,
                contact_email: document.getElementById('contact_email').value,

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
                window.location.href = "/dashboard/user";

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
