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
        <a href="#" class="text-muted text-hover-primary">{{__('site.shipment')}}</a>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')

@endsection

@section('content')

<!-- On Hold Modal -->
<div class="modal fade" id="onHoldModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">On Hold</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="form-group">
                            <label for="from" class="col-form-label">{{__('site.date')}}</label>
                            <input type="date" class="form-control input-sm" form="pdf" name="date">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">{{__('site.note')}}</label>
                            <textarea class="form-control form-control-lg form-control-solid" name="note" form="pdf"
                                style="height: 100px"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary mt-2 status" data-status="onhold">{{ __('site.save_changes') }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- fees paid modal -->
<div class="modal fade" id="feesPaidModal" tabindex="-1" aria-labelledby="feesPaidModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feesPaidModalLabel">rejected fees paid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="form-group">
                            <label for="from" class="col-form-label">{{__('site.paid')}}</label>
                            <input type="text" class="form-control input-sm" name="rejected_fees_paid"  form="pdf">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary mt-2 status" data-status="rejected_fees_paid">{{ __('site.save_changes') }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- export by date modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add the date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pdf') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <input type="hidden" name="export_by_date" value="1">
                        <div class="row">
                            <label for="from" class="col-form-label">From</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control input-sm" id="from" name="from">
                            </div>
                            <label for="from" class="col-form-label">To</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control input-sm" id="to" name="to">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-secondary btn-sm" name="exportPDF">export</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
            <div class="d-flex justify-content-between w-100 fs-4 py-3">
                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_view_search"
                    role="button" aria-expanded="false" aria-controls="kt_view_search">{{ __('site.advanced_search') }}
                    <span class="ms-2">
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
                <div class="d-block d-md-flex align-items-end">
                    <form id="pdf" action="{{ route('pdf') }}" method="POST">
                        @csrf
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="buttin" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('site.optional') }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <button type="submit" class="dropdown-item print" form="pdf">
                                    {{ __('site.print') }}
                                </button>
                            </li>
                            <li>
                                <button type="submit" class="dropdown-item export_by_choose" form="pdf">
                                    {{ __('site.export_by_choose') }}
                                </button>
                            </li>
                            <li>
                                <button type="submit" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    {{ __('site.export_by_date') }}
                                </button>
                            </li>
                        </ul>
                    </div>
                    @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                        <form id="assign_shippments" action="{{ route('driver.assign_shippments') }}" method="POST">
                            @csrf
                            <div class=" me-3">
                                <label class="form-label fs-6 fw-bold">{{__('site.assign_shippments')}}:</label>
                                <select class="form-select form-select-solid fw-bolder assign_shippments_select" name="driver">
                                    <option></option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                {{__('site.status')}}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">\
                                @if(Auth::guard('admin')->check() || Auth::guard('user')->check())
                                    <li>
                                        <button class="dropdown-item status" data-status="receiver_at_hub">
                                            <i class="fa fa-circle" style="color: #94c1e2"></i>&nbsp;received at hub
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item status" data-status="out_for_delivery">
                                            <i class="fa fa-circle" style="color: #7bc1f3"></i>&nbsp;Out For Delivery
                                        </button>
                                    </li>
                                @endif
                                <li>
                                    <button class="dropdown-item status" data-status="delivered">
                                        <i class="fa fa-circle" style="color: #52ec7b"></i>&nbsp;Delivered</a>
                                    </button>
                                </li>
                                <hr>
                                <li>
                                    <button class="dropdown-item" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-bs-toggle="modal" data-bs-target="#onHoldModal" data-bs-whatever="@mdo">
                                        <i class="fa fa-circle" style="color: #b9bc7f"></i>&nbsp;OnHold
                                    </button>
                                </li>

                                <li>
                                    <button class="dropdown-item status" data-status="no_answer">
                                        <i class="fa fa-circle" style="color: #bec35f"></i>&nbsp;No Answer
                                    </button>
                                </li>
                                <hr>
                                <li>
                                    <button class="dropdown-item status" data-status="rejected">
                                        <i
                                            class="fa fa-circle" style="color: #ee83a5"></i>&nbsp;Rejected
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-bs-toggle="modal" data-bs-target="#feesPaidModal" data-bs-whatever="@mdo">
                                        <i class="fa fa-circle" style="color: #ee83a5"></i>&nbsp;Rejected Fees Paid
                                    </button>
                                </li>

                            </ul>
                        </div>
                    @endif
                    @can('shippments.create')
                        <!--begin::Add shipment-->
                        <a href="{{route('shipment.create')}}" class="btn btn-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="black" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->{{__('site.add_shipment')}}
                        </a>
                        <!--end::Add shipment-->
                    @endcan
                    <a href="{{route('view.import')}}" class="ms-2 btn btn-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{__('site.bulk')}}
                    </a>
                </div>

            </div>
        <!--begin::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div id="kt_view_search" class="collapse">
            <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <form action="{{ route('getshipment') }}" method="GET">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.tracking')}}:</label>
                                    <input type="text" class="form-control" name="barcode" value="{{ request('barcode') }}">
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.receiver_name')}}:</label>
                                    <input type="text" name="receiver_name" value="{{ request('receiver_name') }}" class="form-control">
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.receiver_phone')}}:</label>
                                    <input type="text" name="receiver_phone" value="{{ request('receiver_phone') }}" class="form-control">
                                </div>
                                <!--end::Input group-->
                            </div>
                            @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                                <div class="col-12 col-md-6">
                                    <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-bold">{{__('site.driver')}}:</label>
                                            <select class="  form-select form-select-solid fw-bolder" name="driver_id" >
                                                <option></option>
                                                @foreach ($drivers as $driver)
                                                    <option value="{{ $driver->id }}" @if(request('driver_id') == $driver->id) selected @endif>{{ $driver->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-12 col-md-6">
                                    <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-bold">{{__('site.seller')}}:</label>
                                            <select class="form-select form-select-solid fw-bolder" name="seller_id">
                                                <option></option>
                                                @foreach ($sellers as $seller)
                                                    <option value="{{ $seller->id }}" @if(request('seller_id') == $seller->id) selected @endif>{{ $seller->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    <!--end::Input group-->
                                </div>
                            @endif
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.shippment_type')}}:</label>
                                    <select class="form-select form-select-solid fw-bolder" name="shippment_type">
                                        <option></option>
                                        <option value="forward" @if(request('shippment_type') == 'forward') selected @endif>forward</option>
                                        <option value="exchange" @if(request('shippment_type') == 'exchange') selected @endif>exchange</option>
                                        <option value="cash_collection" @if(request('shippment_type') == 'cash_collection') selected @endif>cash_collection</option>
                                        <option value="return_pickup" @if(request('shippment_type') == 'return_pickup') selected @endif>return_pickup</option>

                                    </select>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.status')}}:</label>
                                    <select class="form-select form-select-solid fw-bolder" name="status">
                                        <option></option>
                                @if(Auth::guard('admin')->check() || Auth::guard('user')->check())
                                <option value="receiver_at_hub" @if(request('status') == 'receiver_at_hub') selected @endif>receiver_at_hub</option>
                                <option value="out_for_delivery" @if(request('status') == 'out_for_delivery') selected @endif>Out For Delivery</option>

                                @endif
                                        <option value="delivered" @if(request('status') == 'delivered') selected @endif>Delivered</option>
                                        <option value="onhold" @if(request('status') == 'onhold') selected @endif>OnHold</option>
                                        <option value="no_answer" @if(request('status') == 'no_answer') selected @endif>No Answer</option>
                                        <option value="rejected" @if(request('status') == 'rejected') selected @endif>Rejected</option>
                                        <option value="rejected_fees_paid" @if(request('status') == 'rejected_fees_paid') selected @endif>Rejected Fees Paid</option>

                                    </select>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.seller_settled')}}:</label>
                                    <select class="form-select form-select-solid fw-bolder" name="seller_settled">
                                        <option></option>
                                        <option value="2" @if(request('seller_settled') == '2') selected @endif>{{ __('site.settled') }}</option>
                                        <option value="1" @if(request('seller_settled') == '1') selected @endif>{{ __('site.not_settled') }}</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                            </div>
                            @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                                <div class="col-12">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">{{__('site.driver_settled')}}:</label>
                                        <select class="form-select form-select-solid fw-bolder" name="driver_settled">
                                            <option></option>
                                            <option value="2" @if(request('driver_settled') == '2') selected @endif>{{ __('site.settled') }}</option>
                                            <option value="1" @if(request('driver_settled') == '1') selected @endif>{{ __('site.not_settled') }}</option>

                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            @endif
                            <div class="col-12">
                                <div>
                                    <button class="btn  btn-primary">{{ __('site.search') }}</button>
                                    <a href="{{ route('getshipment') }}" class="btn btn-danger">{{ __('site.reset') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                        </div>
                        <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete
                            Selected</button>
                    </div>
                    <!--end::Group actions-->

                </div>
            <!--end::Card toolbar-->
        </div>
        <!--begin::Table-->
        <table class="table d-block overflow-auto align-middle table-row-dashed fs-6 gy-5">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th  class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input all_check" type="checkbox" />
                        </div>
                    </th>
                    <th class="min-w-125px">{{__('site.tracking')}}</th>
                    <th class="min-w-125px">{{__('site.shippment_type')}}</th>
                    <th class="min-w-125px">{{__('site.seller')}}</th>
                    <th class="min-w-125px">{{__('site.receiver_name')}}</th>
                    <th class="min-w-125px">{{__('site.status')}}</th>
                    <th class="min-w-125px">{{__('site.seller_settled')}}</th>
                    <th class="min-w-125px">{{__('site.driver')}}</th>
                    @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                        <th class="min-w-125px">{{__('site.driver_settled')}}</th>
                    @endif
                    <th class="min-w-125px">{{__('site.print')}}</th>
                    <th class="min-w-125px">{{__('site.phone')}}</th>
                    <th class="min-w-125px">{{__('site.address')}}</th>
                    <th class="min-w-125px">{{__('site.onhold')}}</th>
                    <th class="min-w-125px">{{__('site.price')}}</th>
                    @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                        <th class="min-w-125px">{{__('site.shippment_histories')}}</th>
                    @endif
                    <th class="min-w-125px sorting sorting_desc" aria-sort="descending">{{__('site.created_at')}}</th>
                    <th class="min-w-125px">{{__('site.updated_at')}}</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->

            <tbody class="text-gray-600 fw-bold">

                @foreach ($shipments as $shipment)
                    @php
                        $viewed = 0;
                        $user_type = '';
                        if(Auth::guard('admin')->check())
                            $user_type = 'admin';
                        elseif(Auth::guard('employee')->check())
                            $user_type = 'employee';
                        elseif(Auth::guard('driver')->check())
                            $user_type = 'driver';
                        elseif(Auth::guard('user')->check())
                            $user_type = 'user';

                        $shippment_view = App\Models\ShippmentView::where([
                            'shippment_id' => $shipment->id,
                            'user_id' => Auth::id(),
                            'user_type' => $user_type,
                        ])->first();
                        if($shippment_view) {
                            $viewed = 1;
                        }
                    @endphp
                    <tr class="
                        @if($viewed) bg-light @endif
                    ">
                        <!--begin::Checkbox-->
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input check_input" name="shippment[]" form="pdf" type="checkbox" value="{{$shipment->id}}" />
                                </div>
                            </td>
                        <!--end::Checkbox-->

                        <!--begin::User=-->
                        <td>
                            <span class="badge badge-secondary mb-2 d-block">{{$shipment->barcode}}</span>
                            <form action="{{ route('scan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sometext" value="{{$shipment->barcode}}">
                                <button class="btn btn-secondary w-100">{{__('site.show')}}</button>
                            </form>
                        </td>
                        <td>
                            {{ $shipment->shippment_type }}
                        </td>
                        <td>
                            @if($shipment->user)
                                {{ $shipment->user->name }}
                            @endif
                        </td>
                        <td >
                            <!--begin::User details-->
                            {{$shipment->receiver_name}}
                            <div class="d-flex align-items-center">
                                <a href="https://wa.me/+20{{$shipment->receiver_phone}}">
                                    {{-- <i class="fa fa-user"></i> --}}
                                    <span class="svg-icon svg-icon-1">
                                        <img style="width: 30px" alt="svgImg"
                                            src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iNDgiIGhlaWdodD0iNDgiCnZpZXdCb3g9IjAgMCA0OCA0OCIKc3R5bGU9IiBmaWxsOiN1bmRlZmluZWQ7Ij48cGF0aCBmaWxsPSIjZmZmIiBkPSJNNC44NjgsNDMuMzAzbDIuNjk0LTkuODM1QzUuOSwzMC41OSw1LjAyNiwyNy4zMjQsNS4wMjcsMjMuOTc5QzUuMDMyLDEzLjUxNCwxMy41NDgsNSwyNC4wMTQsNWM1LjA3OSwwLjAwMiw5Ljg0NSwxLjk3OSwxMy40Myw1LjU2NmMzLjU4NCwzLjU4OCw1LjU1OCw4LjM1Niw1LjU1NiwxMy40MjhjLTAuMDA0LDEwLjQ2NS04LjUyMiwxOC45OC0xOC45ODYsMTguOThjLTAuMDAxLDAsMCwwLDAsMGgtMC4wMDhjLTMuMTc3LTAuMDAxLTYuMy0wLjc5OC05LjA3My0yLjMxMUw0Ljg2OCw0My4zMDN6Ij48L3BhdGg+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTQuODY4LDQzLjgwM2MtMC4xMzIsMC0wLjI2LTAuMDUyLTAuMzU1LTAuMTQ4Yy0wLjEyNS0wLjEyNy0wLjE3NC0wLjMxMi0wLjEyNy0wLjQ4M2wyLjYzOS05LjYzNmMtMS42MzYtMi45MDYtMi40OTktNi4yMDYtMi40OTctOS41NTZDNC41MzIsMTMuMjM4LDEzLjI3Myw0LjUsMjQuMDE0LDQuNWM1LjIxLDAuMDAyLDEwLjEwNSwyLjAzMSwxMy43ODQsNS43MTNjMy42NzksMy42ODMsNS43MDQsOC41NzcsNS43MDIsMTMuNzgxYy0wLjAwNCwxMC43NDEtOC43NDYsMTkuNDgtMTkuNDg2LDE5LjQ4Yy0zLjE4OS0wLjAwMS02LjM0NC0wLjc4OC05LjE0NC0yLjI3N2wtOS44NzUsMi41ODlDNC45NTMsNDMuNzk4LDQuOTExLDQzLjgwMyw0Ljg2OCw0My44MDN6Ij48L3BhdGg+PHBhdGggZmlsbD0iI2NmZDhkYyIgZD0iTTI0LjAxNCw1YzUuMDc5LDAuMDAyLDkuODQ1LDEuOTc5LDEzLjQzLDUuNTY2YzMuNTg0LDMuNTg4LDUuNTU4LDguMzU2LDUuNTU2LDEzLjQyOGMtMC4wMDQsMTAuNDY1LTguNTIyLDE4Ljk4LTE4Ljk4NiwxOC45OGgtMC4wMDhjLTMuMTc3LTAuMDAxLTYuMy0wLjc5OC05LjA3My0yLjMxMUw0Ljg2OCw0My4zMDNsMi42OTQtOS44MzVDNS45LDMwLjU5LDUuMDI2LDI3LjMyNCw1LjAyNywyMy45NzlDNS4wMzIsMTMuNTE0LDEzLjU0OCw1LDI0LjAxNCw1IE0yNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0IE0yNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0IE0yNC4wMTQsNEMyNC4wMTQsNCwyNC4wMTQsNCwyNC4wMTQsNEMxMi45OTgsNCw0LjAzMiwxMi45NjIsNC4wMjcsMjMuOTc5Yy0wLjAwMSwzLjM2NywwLjg0OSw2LjY4NSwyLjQ2MSw5LjYyMmwtMi41ODUsOS40MzljLTAuMDk0LDAuMzQ1LDAuMDAyLDAuNzEzLDAuMjU0LDAuOTY3YzAuMTksMC4xOTIsMC40NDcsMC4yOTcsMC43MTEsMC4yOTdjMC4wODUsMCwwLjE3LTAuMDExLDAuMjU0LTAuMDMzbDkuNjg3LTIuNTRjMi44MjgsMS40NjgsNS45OTgsMi4yNDMsOS4xOTcsMi4yNDRjMTEuMDI0LDAsMTkuOTktOC45NjMsMTkuOTk1LTE5Ljk4YzAuMDAyLTUuMzM5LTIuMDc1LTEwLjM1OS01Ljg0OC0xNC4xMzVDMzQuMzc4LDYuMDgzLDI5LjM1Nyw0LjAwMiwyNC4wMTQsNEwyNC4wMTQsNHoiPjwvcGF0aD48cGF0aCBmaWxsPSIjNDBjMzUxIiBkPSJNMzUuMTc2LDEyLjgzMmMtMi45OC0yLjk4Mi02Ljk0MS00LjYyNS0xMS4xNTctNC42MjZjLTguNzA0LDAtMTUuNzgzLDcuMDc2LTE1Ljc4NywxNS43NzRjLTAuMDAxLDIuOTgxLDAuODMzLDUuODgzLDIuNDEzLDguMzk2bDAuMzc2LDAuNTk3bC0xLjU5NSw1LjgyMWw1Ljk3My0xLjU2NmwwLjU3NywwLjM0MmMyLjQyMiwxLjQzOCw1LjIsMi4xOTgsOC4wMzIsMi4xOTloMC4wMDZjOC42OTgsMCwxNS43NzctNy4wNzcsMTUuNzgtMTUuNzc2QzM5Ljc5NSwxOS43NzgsMzguMTU2LDE1LjgxNCwzNS4xNzYsMTIuODMyeiI+PC9wYXRoPjxwYXRoIGZpbGw9IiNmZmYiIGZpbGwtcnVsZT0iZXZlbm9kZCIgZD0iTTE5LjI2OCwxNi4wNDVjLTAuMzU1LTAuNzktMC43MjktMC44MDYtMS4wNjgtMC44MmMtMC4yNzctMC4wMTItMC41OTMtMC4wMTEtMC45MDktMC4wMTFjLTAuMzE2LDAtMC44MywwLjExOS0xLjI2NSwwLjU5NGMtMC40MzUsMC40NzUtMS42NjEsMS42MjItMS42NjEsMy45NTZjMCwyLjMzNCwxLjcsNC41OSwxLjkzNyw0LjkwNmMwLjIzNywwLjMxNiwzLjI4Miw1LjI1OSw4LjEwNCw3LjE2MWM0LjAwNywxLjU4LDQuODIzLDEuMjY2LDUuNjkzLDEuMTg3YzAuODctMC4wNzksMi44MDctMS4xNDcsMy4yMDItMi4yNTVjMC4zOTUtMS4xMDgsMC4zOTUtMi4wNTcsMC4yNzctMi4yNTVjLTAuMTE5LTAuMTk4LTAuNDM1LTAuMzE2LTAuOTA5LTAuNTU0cy0yLjgwNy0xLjM4NS0zLjI0Mi0xLjU0M2MtMC40MzUtMC4xNTgtMC43NTEtMC4yMzctMS4wNjgsMC4yMzhjLTAuMzE2LDAuNDc0LTEuMjI1LDEuNTQzLTEuNTAyLDEuODU5Yy0wLjI3NywwLjMxNy0wLjU1NCwwLjM1Ny0xLjAyOCwwLjExOWMtMC40NzQtMC4yMzgtMi4wMDItMC43MzgtMy44MTUtMi4zNTRjLTEuNDEtMS4yNTctMi4zNjItMi44MS0yLjYzOS0zLjI4NWMtMC4yNzctMC40NzQtMC4wMy0wLjczMSwwLjIwOC0wLjk2OGMwLjIxMy0wLjIxMywwLjQ3NC0wLjU1NCwwLjcxMi0wLjgzMWMwLjIzNy0wLjI3NywwLjMxNi0wLjQ3NSwwLjQ3NC0wLjc5MWMwLjE1OC0wLjMxNywwLjA3OS0wLjU5NC0wLjA0LTAuODMxQzIwLjYxMiwxOS4zMjksMTkuNjksMTYuOTgzLDE5LjI2OCwxNi4wNDV6IiBjbGlwLXJ1bGU9ImV2ZW5vZGQiPjwvcGF0aD48L3N2Zz4=" />
                                    </span>
                                </a>
                                <a class="ms-2" href="tel:+20{{$shipment->receiver_phone}}">
                                    {{-- <i class="fa fa-user"></i> --}}
                                    <span class="svg-icon svg-icon-1">
                                        <i class="bi bi-telephone-fill"></i>
                                    </span>
                                </a>
                                <a class="ms-2" href="{{route('shipment.show',$shipment->id)}}">
                                    {{-- <i class="fa fa-user"></i> --}}
                                    <span class="svg-icon svg-icon-1">
                                        <i class="bi bi-truck"></i>
                                    </span>
                                </a>

                            </div>
                            <!--begin::User details-->
                        </td>
                        <!--end::User=-->


                        <td>
                            @if ($shipment->status == 'receiver_at_hub')
                                <div class="rounded-pill p-2" style="background-color: #94c1e2;text-align: center">
                                    {{$shipment->status}}</div>
                            @elseif($shipment->status == 'out_for_delivery')
                                <div class="rounded-pill p-2" style="background-color: #7bc1f3;text-align: center">
                                    {{$shipment->status}}</div>
                            @elseif($shipment->status == 'delivered')
                                <div class="rounded-pill p-2" style="background-color: #52ec7b;text-align: center">
                                    {{$shipment->status}}</div>
                            @elseif($shipment->status == 'OnHold')
                                <div class="rounded-pill p-2" style="background-color: #b9bc7f;text-align: center">
                                    {{$shipment->status}}</div>
                            @elseif($shipment->status == 'no_answer')
                                <div class="rounded-pill p-2" style="background-color: #bec35f;text-align: center">
                                    {{$shipment->status}}</div>
                            @elseif($shipment->status == 'rejected')
                                <div class="rounded-pill p-2" style="background-color: #ee83a5;text-align: center">
                                    {{$shipment->status}}</div>
                            @elseif($shipment->status == 'rejected_fees_paid')
                                <div class="rounded-pill p-2" style="background-color: #fcc6c6;text-align: center">
                                    {{$shipment->status}}</div>
                            @elseif($shipment->status == 'created')
                                <div class="rounded-pill p-2" style="background-color: #b2cd94;text-align: center">
                                    {{$shipment->status}}</div>
                            @else
                                <div class="rounded-pill p-2" style="background-color: #cbcbcb;text-align: center">{{ $shipment->status }}</div>
                            @endif
                            @if($shipment->rejected_fees_paid)
                                <span class="mt-2 badge badge-secondary text-center d-block">
                                    {{ $shipment->rejected_fees_paid }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($shipment->seller_settled)
                                <span class="badge badge-success">
                                    <i class="fas fa-check"></i>
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <i class="fas fa-times"></i>
                                </span>
                            @endif
                        </td>
                        <td>
                            @foreach ($shipment->deliveries as $delivery)
                                {{ $delivery->driver->name }}<br>
                            @endforeach
                        </td>
                        @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                            <td>
                                @if($shipment->driver_settled)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </span>
                                @endif
                            </td>
                        @endif
                        <td>
                            {{-- <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"> --}}
                                    <a href="{{route('print',$shipment->id)}}" target="_blank">
                                        <i class="fa fa-print"></i>
                                        {{-- {{__('site.export')}} --}}
                                    </a>
                                    {{--
                                </div>
                            </div> --}}
                        </td>

                        <td>{{$shipment->receiver_phone}}</td>

                        <td>
                            <div class="badge badge-light fw-bolder">{{$shipment->address}}</div>
                        </td>


                        @if ($shipment->on_hold == null)
                        <td>--</td>
                        @else
                        <td>{{$shipment->on_hold}}</td>
                        @endif

                        <td>{{$shipment->price}}</td>
                        @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($shipment->histories()->latest()->get() as $history)
                                        @if($history->user)
                                            <li class="list-unstyled mb-2">
                                                <ul>
                                                    <li class="d-flex align-items-center">
                                                        <h5 class="m-0 pe-1">{{ __('site.employee') }}: </h5>
                                                        <span>{{ $history->user->name }}</span>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <h5 class="m-0 pe-1">{{ __('site.status') }}: </h5>
                                                        <span>{{ $history->status }}</span>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <h5 class="m-0 pe-1">{{ __('site.date') }}: </h5>
                                                        <span class="max">{{ \Carbon\Carbon::parse($history->created_at)->format('Y-m-d / h:i:s') }}</span>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                        @endif
                        <td>{{\Carbon\Carbon::parse($shipment->created_at)->format('Y-m-d / h:i:s')}}</td>
                        <td>{{\Carbon\Carbon::parse($shipment->updated_at)->format('Y-m-d / h:i:s')}}</td>

                        <!--begin::Action=-->
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">Actions
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                @can('shippments.show')
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{route('shipment.show',$shipment->id)}}" class="menu-link px-3">show</a>
                                    </div>
                                    <!--end::Menu item-->
                                @endcan
                                @can('shippments.edit')
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{route('shipment.edit',$shipment->id)}}" class="menu-link px-3">Edit</a>
                                    </div>
                                    <!--end::Menu item-->
                                @endcan
                                @can('shippments.destroy')
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 delete_btn" data-id="{{ $shipment->id }}">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                                @endcan
                            </div>
                            <!--end::Menu-->
                        </td>
                        <!--end::Action=-->
                        <td></td>

                    </tr>

                @endforeach

            </tbody>
            <!--end::Table body-->
        </table>
        {{ $shipments->appends(request()->all())->links()}}
        <!--end::Table-->
        <!--Modal Deletaion-->
        <div class="modal fade" id="delete_shipping" tabindex="-1" aria-labelledby="delete_shippingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleted</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are You sure to delete it ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->

@endsection

@push('scripts')

{{-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script> --}}

<script>
    $(".all_check").on('click', function() {
        $("input[name='shippment[]']").click();

    });

    $(".delete_btn").on('click', function() {
        $("#delete_shipping").modal('show');
        $("#delete_shipping").find('form').attr('action', '/dashboard/shipment/' + $(this).data('id'));
    });


    $(".assign_shippments_select").on('change', function() {
        $(".check_input").attr('form', 'assign_shippments');
        $(this).parent().parent().submit();
    });

    $(".status").on('click', function() {
        $("#pdf").append(`<input type='hidden' name='status' value='${$(this).data('status')}'>`)
        $("#pdf").submit();
    });


</script>
<script>

    $(".print").on('click', function() {
        $("#pdf").append('<input type="hidden" name="print" value="1">')
    });

    var input = document.querySelector('input[name=driver_id]'),
        // init Tagify script on the above inputs
        tagify = new Tagify(input, {
            whitelist : [
                @foreach ($drivers as $driver)
                    "{{$driver->name}}",
                @endforeach
            ],
            dropdown: {
                closeOnSelect: false,
                maxItems: Infinity,
                enabled: 0,
                classname: "customSuggestionsList",

            },
            templates: {
                dropdownItemNoMatch() {
                    return `<div class='empty'>Nothing Found</div>`;
                }
            },
            enforceWhitelist: true
        })

    tagify.on("dropdown:show", onSuggestionsListUpdate)
        .on("dropdown:hide", onSuggestionsListHide)
        .on('dropdown:scroll', onDropdownScroll)

    renderSuggestionsList()  // defined down below

    // ES2015 argument destructuring
    function onSuggestionsListUpdate({ detail:suggestionsElm }){
        console.log(  suggestionsElm  )
    }

    function onSuggestionsListHide(){
        console.log("hide dropdown")
    }

    function onDropdownScroll(e){
        console.log(e.detail)
    }

    // https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentElement
    function renderSuggestionsList(){
        tagify.dropdown.show() // load the list
        tagify.DOM.scope.parentNode.appendChild(tagify.DOM.dropdown)
    }
</script>
<script>
    // //update the status shipment details
    function addshipment(statusofshipment) {
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
                shipment_id: '',
                date:document.getElementById('date').value,
                note:document.getElementById('note').value,
            };
        } else if(status == 'rejected_fees_paid') {
            let obj = {
                status: status,
                shipment_id: '',
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
@endpush
