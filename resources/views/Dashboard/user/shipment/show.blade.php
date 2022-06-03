@extends('Dashboard.app')

@section('title',__('site.add'))

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
        <a href="" class="text-muted text-hover-primary">{{__('site.showshipment')}}</a>
    </li>
    <!--end::Item-->
</ul>

{{-- <a href="{{route('print',$shippment->id)}}"> print</a> --}}
{{-- <a href="{{route('shipment.print')}}">print</a> --}}

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

        {{-- //export link --}}
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{route('print',$shippment->id)}}" class="btn btn-primary">
                    <i class="fa fa-print"></i>
                    {{__('site.print')}}
                </a>
            </div>
        </div>


    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                @if ($shippment->on_hold != null)
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{__('site.onhold')}}</label>
                    <input type="date" class="form-control form-control-lg form-control-solid"
                        value="{{$shippment->on_hold}}" name="" id="">
                </div>
                @endif

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
                                    <option value="{{$shippment->shippment_type}}" disabled selected>
                                        {{$shippment->shippment_type}}
                                    </option>
                                    {{-- <option value="forward">Forward </option>
                                    <option value="exchange">exchange </option>
                                    <option value="cash_collection">cash collection </option> --}}

                                </select>
                            </div>
                            <!--end::shipment type-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.business')}}</label>
                                <input type="text" id="business" name="business"
                                    value="{{$shippment->business_referance}}"
                                    class="form-control form-control-lg form-control-solid">
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
                                    value="{{$shippment->receiver_name}}"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::receiver name-->

                            <!--begin::phone-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.phone')}}</label>
                                <input type="text" id="receiver_phone" name="receiver_phone"
                                    value="{{$shippment->receiver_phone}}"
                                    class="form-control form-control-lg form-control-solid">
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
                            class="form-control form-control-lg form-control-solid" value="{{$shippment->address}}">
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
                                <option value="{{$shippment->city->city}}" disabled selected>
                                    {{$shippment->city->city}}
                                </option>

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
                                <option value="{{$shippment->area->area}}" disabled selected>
                                    {{$shippment->area->area}}
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
                <!--end::city && area-->

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
                            style="height: 100px" aria-valuemax="{{$shippment->package_details}}"></textarea>
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
                            class="form-control form-control-lg form-control-solid" value="{{$shippment->price}}">
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
                            style="height: 100px" aria-valuemax="{{$shippment->note}}"></textarea>
                        <label for="note">{{__('site.note')}}</label>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::note-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            {{-- <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="addshipment()" class="btn btn-primary"
                    id="kt_account_profile_details_submit">
                    {{__('site.add')}}
                </button>
            </div> --}}
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

        //add shipment details
        function addshipment() {
            axios.post('/dashboard/shipment', {
                user_id:{{auth()->user()->id}},
                // address_line: document.getElementById('address_line').value,
                area: document.getElementById('area').value,
                city: document.getElementById('city').value,
                shipment_type: document.getElementById('shipment_type').value,
                business: document.getElementById('business').value,
                receiver_name: document.getElementById('receiver_name').value,
                receiver_phone: document.getElementById('receiver_phone').value,
                address: document.getElementById('address').value,
                package:document.getElementById('package').value,
                price:document.getElementById('price').value,
                note:document.getElementById('note').value,
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
