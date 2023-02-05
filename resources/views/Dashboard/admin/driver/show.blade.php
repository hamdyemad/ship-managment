@extends('Dashboard.app')

@section('title',__('site.shipment'))

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
        <span class="text-muted ">{{__('site.showshipment')}}</span>
    </li>
    <!--end::Item-->
</ul>


@endsection

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>

</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />

@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add the date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="ViewPages" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <label for="from" class="col-form-label">{{__('site.date')}}</label>
                            <div class="col-md-12">
                                <input type="date" class="form-control input-sm" id="date" name="date">
                            </div>
                            <label for="from" class="col-form-label">{{__('site.note')}}</label>
                            <div class="col-md-12">
                                <textarea class="form-control form-control-lg form-control-solid" name="note" id="note"
                                    style="height: 100px"></textarea>
                            </div>

                            <div class="col-md-4">
                                <button type="button" onclick="addshipment('onhold', {{ $shippment->id }})" class="btn btn-secondary btn-sm"
                                    name="">
                                    add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="feesPaidModal" tabindex="-1" aria-labelledby="feesPaidModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feesPaidModalLabel">rejected fees paid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="ViewPages" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <label for="from" class="col-form-label">{{__('site.paid')}}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-sm" name="rejected_fees_paid" id="rejected_fees_paid">
                            </div>
                            <div class="col-md-4">
                                <button type="button" onclick="addshipment('rejected_fees_paid', {{ $shippment->id }})" class="btn btn-secondary btn-sm"
                                    name="">
                                    update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details"
        aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('site.shipment') . '-' . $shippment->barcode }}</h3>
        </div>
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('site.status')}}: {{$shippment->status }}</h3>
        </div>
        <!--end::Card title-->



        {{-- //status --}}
        <div class="card-toolbar">
            {{-- status dropdown --}}
            @if(Auth::guard('driver')->user() && !$shippment->driver_changed
            || $shippment->status != 'no_answer'
          /*  ||Auth::guard('user')->check()*/
            ||Auth::guard('admin')->check()
            ||Auth::guard('employee')->check()
            )
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{__('site.status')}}
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if(Auth::guard('admin')->check() || Auth::guard('user')->check())
                                <li><a class="dropdown-item" onclick="addshipment('receiver_at_hub',{{$shippment->id}})"><i
                                            class="fa fa-circle" style="color: #94c1e2"></i>&nbsp;received at hub</a>
                                </li>
                                <hr>
                                <li><a class="dropdown-item" onclick="addshipment('out_for_delivery',{{$shippment->id}})"><i
                                            class="fa fa-circle" style="color: #7bc1f3"></i>&nbsp;Out For Delivery</a>
                                </li>
                            @endif
                            <li><a class="dropdown-item" onclick="addshipment('delivered',{{$shippment->id}})"><i
                                        class="fa fa-circle" style="color: #52ec7b"></i>&nbsp;Delivered</a>
                            </li>
                            <hr>
                            <li><a class="dropdown-item" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i
                                        class="fa fa-circle" style="color: #b9bc7f"></i>&nbsp;OnHold</a>
                            </li>

                            <li><a class="dropdown-item" onclick="addshipment('no_answer',{{$shippment->id}})"><i
                                        class="fa fa-circle" style="color: #bec35f"></i>&nbsp;No Answer</a>
                            </li>
                            <hr>
                            <li><a class="dropdown-item" onclick="addshipment('rejected',{{$shippment->id}})"><i
                                        class="fa fa-circle" style="color: #ee83a5"></i>&nbsp;Rejected</a>
                            </li>
                            <li><a class="dropdown-item" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                data-bs-toggle="modal" data-bs-target="#feesPaidModal" data-bs-whatever="@mdo"><i
                                        class="fa fa-circle" style="color: #ee83a5"></i>&nbsp;Rejected Fees Paid</a>
                            </li>

                        </ul>
                </div>
            @endif

            {{-- print --}}
            <a href="{{route('print',$shippment->id)}}" class="btn btn-light-primary me-3 ms-3">
                <i class="fa fa-print"></i>
                {{__('site.print')}}
            </a>
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{route('tracking.show',$shippment->id)}}" class="btn btn-light-primary me-3">
                    <i class="fa fa-truck"></i>
                    {{__('site.tracking')}}
                </a>
            </div>&nbsp;
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
                                <select disabled name="shipment_type" id="shipment_type" data-placeholder="date_period"
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
                                <input disabled type="text" id="business" name="business"
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
                                <input disabled type="text" id="receiver_name" name="receiver_name"
                                    value="{{$shippment->receiver_name}}"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::receiver name-->

                            <!--begin::phone-->
                            <div class="col-lg-6 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.phone')}}</label>
                                <input disabled type="text" id="receiver_phone" name="receiver_phone"
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
                        <input disabled type="text" id="address" name="address"
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
                            <select disabled data-dependent="area" name="city" id="city" aria-label="Select a Timezone"
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
                            <select disabled name="area" id="area" aria-label="Select a Timezone" data-control="select2"
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
                        <textarea disabled class="form-control form-control-lg form-control-solid" name="package" id="package"
                            style="height: 100px" aria-valuemax="">{{$shippment->package_details}}</textarea>
                        <label for="package">{{__('site.package')}}</label>

                    </div>
                    <!--end::Col-->
                </div>
                <!--end::package-->

                <!--begin::price-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="form-floating">
                        <input disabled type="number" id="price" name="price"
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
                        <textarea disabled class="form-control form-control-lg form-control-solid" name="note" id="note"
                            style="height: 100px" aria-valuemax="">{{$shippment->note}}</textarea>
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
    // //update the status shipment details
        function addshipment(statusofshipment,id) {
            let obj = {
                status: statusofshipment,
                shipment_id: id,
            };
            if(statusofshipment == 'rejected_fees_paid') {
                obj.rejected_fees_paid = document.getElementById('rejected_fees_paid').value
            }
            if(statusofshipment == 'onhole') {
                obj.date = document.getElementById('date').value,
                obj.note = document.getElementById('note').value
            }
            axios.post('/dashboard/driver/shipment/status', obj)
            .then(function (response) {
                console.log(response.data);
                //2xx
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

        // update status to on hold
         function updatestatusshipment(status, url) {
            // onhold
            if(status == 'onhold') {
                let obj = {
                    status: status,
                    shipment_id: '{{$shippment->id}}',
                    date:document.getElementById('date').value,
                    note:document.getElementById('note').value,
                };
            } else if(status == 'rejected_fees_paid') {
                let obj = {
                    status: status,
                    shipment_id: '{{$shippment->id}}',
                    rejected_fees_paid:document.getElementById('rejected_fees_paid').value,
                }
            }
            axios.post(url, obj)
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
