@extends('Dashboard.app')

@section('title',__('site.address'))

@section('page_name',__('site.address'))


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
        <a href="{{route('pickup.index')}}" class="text-muted text-hover-primary">{{__('site.pickup')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->

    <li class="breadcrumb-item text-muted">
        <a href="" class="text-muted text-hover-primary">{{__('site.address')}}</a>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')

@endsection

@section('content')

<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details"
        aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('site.add_address')}}</h3>
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

                <div class="container">
                    @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                        <div class="row mb-12">
                            <!--begin::shipment type-->
                            <div class="col-lg-12 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.shipment.seller')}}</label>
                                <select name="user_id" id="shipment_seller"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    <option value="">{{ __('site.choose_seller') }}</option>
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->id }}" @if(request('user_id') == $seller->id) selected @endif>{{ $seller->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!--end::shipment type-->
                        </div>
                    @endif
                    <div class="row">

                        <!--begin::Input building-->
                        <div class="row mb-12">
                            <!--begin::Label-->
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <!--begin::Row-->
                                <div class="row">

                                    <!--begin::address line-->
                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                        <textarea id="address_line" name="address_line"
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                            placeholder="address line"></textarea>
                                        <div class="fv-plugins-message-container invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::address line-->

                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">

                                    <!--begin::city-->
                                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                        <div class="mb-5">
                                            <select data-dependent="area" name="city" id="city"
                                                aria-label="Select a Timezone" data-control="select2"
                                                data-placeholder="date_period"
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
                                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                        <div class="mb-5">
                                            <select name="area" id="area" aria-label="Select a Timezone"
                                                data-control="select2" data-placeholder="date_period"
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

                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">

                                    <!--begin::building-->
                                    <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                        <input type="text" id="building" name="building"
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                            placeholder="building">
                                        <div class="fv-plugins-message-container invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::building-->

                                    <!--begin::floor-->
                                    <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                        <input type="text" id="floor" name="floor"
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                            placeholder="floor">
                                        <div class="fv-plugins-message-container invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::floor-->

                                    <!--begin::apartment-->
                                    <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                        <input type="text" id="apartment" name="apartment"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="apartment">
                                        <div class="fv-plugins-message-container invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::apartment-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input building-->

                        <!--begin::Input contact-->
                        <div class="d-flex flex-stack fs-4 py-3">
                            <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="" role="button"
                                aria-expanded="" aria-controls="kt_user_view_details">
                                Contact info
                                <span class="ms-2 rotate-180">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-3">

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>

                        </div>

                        <div class="row mb-12">
                            <!--begin::Label-->
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                        <input type="text" id="contact_name" name="contact_name"
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                            placeholder="contact name">
                                        <div class="fv-plugins-message-container invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                        <input type="text" id="contact_mobile" name="contact_mobile"
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                            placeholder="contact mobile">
                                        <div class="fv-plugins-message-container invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                        <input type="text" id="contact_email" name="contact_email"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="contact email">
                                        <div class="fv-plugins-message-container invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input contact-->

                        <!--end::Card body-->
                    </div>
                </div>

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="addaddress()" class="btn btn-primary"
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
    //add user address for pickup
        function addaddress() {
                axios.post('/dashboard/address', {
                    @if(Auth::guard('user')->check())
                        user_id:{{auth()->user()->id}},
                    @else
                        user_id: document.getElementById('shipment_seller').value,
                    @endif
                    address_line: document.getElementById('address_line').value,
                    area: document.getElementById('area').value,
                    city: document.getElementById('city').value,
                    building: document.getElementById('building').value,
                    floor: document.getElementById('floor').value,
                    apartment: document.getElementById('apartment').value,
                    contact_name: document.getElementById('contact_name').value,
                    contact_mobile: document.getElementById('contact_mobile').value,
                    contact_email:document.getElementById('contact_email').value,
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
                    // location.reload();
                    window.location.href = "/dashboard/pickup/create";

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
                // $('#city').val('');
                });

                // $('#state').change(function(){
                // $('#city').val('');
                // });


        });

</script>

@endsection
