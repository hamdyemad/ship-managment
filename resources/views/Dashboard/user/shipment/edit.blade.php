@extends('Dashboard.app')

@section('title',__('site.edit'))

@section('page_name',__('site.shipment'))


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
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('shipment.index')}}" class="text-muted text-hover-primary">{{__('site.shipment')}}</a>
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
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details"
        aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('site.shipment')}}</h3>
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
                                    <option value="{{ $seller->id }}" @if($shipment->user_id == $seller->id) selected @endif>{{ $seller->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <!--end::shipment type-->
                    </div>
                @endif
                <!--begin::shipper-->
                <div class="row mb-12">
                    <!--begin::Col-->
                    <div class="col-lg-12 fv-row">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.shipper-name')}}</label>

                        <input type="text" id="shipper" name="shipper"
                            class="form-control form-control-lg form-control-solid" value="{{ $shipment->shipper }}">

                    </div>
                    <!--end::Col-->
                </div>
                <!--end::shipper-->

                <!--begin::shipment && business-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::shipment type-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.shipment_type')}}</label>
                                <select name="shipment_type" id="shipment_type" data-placeholder="date_period"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    <option value="" disabled selected>Select one ..
                                    </option>
                                    <option value="forward" @if($shipment->shippment_type == 'forward') selected @endif>Forward</option>
                                    <option value="exchange" @if($shipment->shippment_type == 'exchange') selected @endif>exchange</option>
                                    <option value="cash_collection" @if($shipment->shippment_type == 'cash_collection') selected @endif>cash collection</option>
                                    <option value="return_pickup" @if($shipment->shippment_type == 'return_pickup') selected @endif>return pickup</option>

                                </select>
                            </div>
                            <!--end::shipment type-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.business')}}</label>
                                <input type="text" id="business" name="business"
                                    class="form-control form-control-lg form-control-solid" value="{{ $shipment->business_referance }}">
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::shipment && business-->

                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="" role="button"
                        aria-expanded="" aria-controls="kt_user_view_details">
                        {{__('site.receiver')}}
                        <span class="ms-2 rotate-180">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-3">

                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>

                </div>

                <!--begin::name && phone-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::receiver name-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.name')}}</label>
                                <input type="text" id="receiver_name" name="receiver_name"
                                    class="form-control form-control-lg form-control-solid" value="{{ $shipment->receiver_name }}">
                            </div>
                            <!--end::receiver name-->

                            <!--begin::phone-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.phone')}}</label>
                                <input type="text" id="receiver_phone" name="receiver_phone"
                                    class="form-control form-control-lg form-control-solid" value="{{ $shipment->receiver_phone }}">
                            </div>
                            <!--end::phone-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::name && phone-->

                <!--begin::address-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="form-floating">
                        {{-- <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.address')}}</label>
                        --}}
                        <input type="text" id="address" name="address"
                            class="form-control form-control-lg form-control-solid" value="{{ $shipment->address }}">
                        <label for="address" class="col-lg-4 col-form-label fw-bold fs-6">address</label>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::address-->

                <!--begin::city && area-->
                <div class="row">

                    <!--begin::city-->
                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            <select data-dependent="area" name="city" id="city" aria-label="Select a Timezone"
                                data-control="select2" data-placeholder="date_period"
                                class="form-select form-select-sm form-select-solid dynamic">
                                <option value="" disabled selected>City
                                </option>
                                @foreach ($city as $city)
                                <option id="cityid" @if($shipment->city_id == $city->id) selected @endif value="{{$city->id}}">
                                    {{$city->city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><br><br>
                    <!--end::city-->

                    <!--begin::area-->
                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                        <div class="mb-5">
                            <select name="area" id="area" aria-label="Select a Timezone" data-control="select2"
                                data-placeholder="date_period"
                                class="form-select form-select-sm form-select-solid dynamic">
                                <option value="" disabled selected></option>
                            </select>
                        </div>
                        {{ csrf_field() }}
                    </div>
                    <!--end::area-->

                </div>
                <!--end::city && area-->
                <br>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="togBtn" value="{{ $shipment->allow_open }}" name="disableYXLogo"
                        @if($shipment->allow_open == 'true')
                        checked
                        @endif>
                    <label class="form-check-label" for="flexSwitchCheckDefault">{{__('site.allow_open')}}</label>
                </div>
                <br>
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="" role="button"
                        aria-expanded="" aria-controls="kt_user_view_details">
                        {{__('site.package')}}
                        <span class="ms-2 rotate-180">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-3">

                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>

                </div>

                <!--begin::package-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="form-floating">
                        <textarea class="form-control form-control-lg form-control-solid" name="package" id="package"
                            style="height: 100px">{{ $shipment->package_details }}</textarea>
                        <label for="package">{{__('site.package')}}</label>

                    </div>
                    <!--end::Col-->
                </div>
                <!--end::package-->

                <!--begin::price-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="form-floating">
                        <input type="number" id="price" name="price"
                            class="form-control form-control-lg form-control-solid" value="{{ $shipment->price }}">
                        <label for="price" class="col-lg-4 col-form-label fw-bold fs-6">{{__('site.price')}}</label>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::price-->

                <!--begin::note-->
                <div class="row mb-8">
                    <!--begin::Col-->
                    <div class="form-floating">
                        <textarea class="form-control form-control-lg form-control-solid" name="note" id="note"
                            style="height: 100px">{{ $shipment->note }}</textarea>
                        <label for="note">{{__('site.note')}}</label>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::note-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="editshipment()" class="btn btn-primary"
                    id="kt_account_profile_details_submit">
                    {{__('site.edit')}}
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

            if($('.dynamic').val() != '')
                {
                    var select = $('.dynamic').attr("id");
                    var value = $('.dynamic').val();
                    var dependent = $('.dynamic').data('dependent');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('dynamicdependent.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {
                            $('#'+ dependent).html(result);
                            if("{{ $shipment->area_id }}" !== null) {
                                let area_id = "{{ $shipment->area_id }}";
                                $('#'+ dependent + ` option[value="${area_id}"]`).attr("selected", "selected");
                            }
                        }
                    })
                }

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


        //add shipment details
        function editshipment() {
            axios.patch('/dashboard/shipment/' + "{{ $shipment->id }}", {
                @if(Auth::guard('user')->check())
                    user_id:{{auth()->user()->id}},
                @else
                    user_id: document.getElementById('shipment_seller').value,
                @endif
                area: document.getElementById('area').value,
                city: document.getElementById('city').value,
                shipment_type: document.getElementById('shipment_type').value,
                shipper: document.getElementById('shipper').value,
                business: document.getElementById('business').value,
                receiver_name: document.getElementById('receiver_name').value,
                receiver_phone: document.getElementById('receiver_phone').value,
                address: document.getElementById('address').value,
                package:document.getElementById('package').value,
                price:document.getElementById('price').value,
                note:document.getElementById('note').value,
                active:$("#togBtn").prop('checked') == true ? 1 : 0,
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

            })
            .catch(function (error) {
                document.getElementById('business').style.borderColor = "#f5f8fa";
                document.getElementById('shipment_type').style.borderColor = "#f5f8fa";
                document.getElementById('shipper').style.borderColor = "#f5f8fa";
                document.getElementById('receiver_name').style.borderColor = "#f5f8fa";
                document.getElementById('receiver_phone').style.borderColor = "#f5f8fa";
                document.getElementById('address').style.borderColor = "#f5f8fa";
                document.getElementById('city').style.borderColor = "#f5f8fa";
                document.getElementById('area').style.borderColor = "#f5f8fa";

                if (error.response.data.errors['user_id']){
                    document.getElementById('shipment_seller').style.borderColor = "red";
                }
                if (error.response.data.errors['price']){
                    document.getElementById('price').style.borderColor = "red";
                }

                if (error.response.data.errors['business']){
                    document.getElementById('business').style.borderColor = "red";
                }
                if (error.response.data.errors['shipment_type']){
                    document.getElementById('shipment_type').style.borderColor = "red";
                }
                if (error.response.data.errors['shipper']){
                    document.getElementById('shipper').style.borderColor = "red";
                }
                if (error.response.data.errors['receiver_name']){
                    document.getElementById('receiver_name').style.borderColor = "red";
                }
                if (error.response.data.errors['receiver_phone']){
                    document.getElementById('receiver_phone').style.borderColor = "red";
                }
                if (error.response.data.errors['address']){
                    document.getElementById('address').style.borderColor = "red";
                }
                if (error.response.data.errors['city']){
                    document.getElementById('city').style.borderColor = "red";
                }
                if (error.response.data.errors['area']){
                    document.getElementById('area').style.borderColor = "red";
                }
                console.log(error.response.data.errors);
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
