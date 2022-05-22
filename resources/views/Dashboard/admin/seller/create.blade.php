@extends('Dashboard.app')

@section('title',__('site.add'))

@section('page_name',__('site.seller'))


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
        <a href="" class="text-muted text-hover-primary">{{__('site.user')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="" class="text-muted text-hover-primary">{{__('site.create')}}</a>
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
            <h3 class="fw-bolder m-0">{{__('site.add_seller')}}</h3>
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
                    <input type="text" id="name" name="name" class="form-control form-control-lg form-control-solid">

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
                                <input type="email" id="email" name="email"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::email-->

                            <!--begin::phone-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.phone')}}</label>
                                <input type="text" id="phone" name="phone"
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

                <!--begin::city && area-->
                <div class="row">

                    <!--begin::city-->
                    <div class="col-lg-4 fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            <select data-dependent="area" name="city" id="city" aria-label="Select a Timezone"
                                data-control="select2" data-placeholder="date_period"
                                class="form-select form-select-sm form-select-solid dynamic">
                                <option value="" disabled selected>City
                                </option>
                                @foreach ($city as $city)
                                <option id="cityid" value="{{$city->id}}">
                                    {{$city->city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><br><br>
                    <!--end::city-->

                    <!--begin::area-->
                    <div class="col-lg-4 fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            <select name="area" id="area" aria-label="Select a Timezone" data-control="select2"
                                data-placeholder="date_period"
                                class="form-select form-select-sm form-select-solid dynamic">
                                <option value="" disabled selected>
                                </option>

                                {{-- @foreach ($area as $area)
                                <option value="{{$area->id}}">{{$area->area}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        {{ csrf_field() }}
                    </div>
                    <!--end::area-->

                    <div class="col-lg-4 fv-row fv-plugins-icon-container">
                        <div class="mb-5">

                            <input type="number" name="special_price" id="special_price" placeholder="special price"
                                class="form-control form-control-sm form-control-solid">
                            {{-- <label
                                class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.price')}}</label> --}}

                        </div>

                    </div>

                </div>
                <!--end::city && area-->

                <!--begin::price of pickup-->
                <div class="row">


                    <div class="col-lg-4 fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">pickup price</label>
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
                <button type="button" onclick="addseller()" class="btn btn-primary"
                    id="kt_account_profile_details_submit">
                    {{__('site.add')}}
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
    //show city and his area in select tag
        $(document).ready(function(){
            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('dynamicdependent.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {
                        $('#'+ dependent).html(result);
                        }

                    })
                }
            });

                $('#city').change(function(){
                $('#area').val('');

            });
        });

    //add seller (user) to the system
        function addseller() {
            axios.post('/dashboard/user', {

                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                password: document.getElementById('password').value,
                city: document.getElementById('city').value,
                area: document.getElementById('area').value,
                special_price: document.getElementById('special_price').value,
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
