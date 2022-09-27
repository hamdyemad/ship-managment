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
<div class="card all_shippments">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
            <div class="d-flex justify-content-between w-100 fs-4 py-3">
                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_view_search"
                    role="button" aria-expanded="false" aria-controls="kt_view_search">Advanced Search
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
                <div class="d-block d-md-flex">
                    <form id="pdf" action="{{ route('pdf') }}" method="POST">
                        @csrf
                        <input type="hidden" name="export_by_choose" value="1">
                        <button type="submit" class="btn btn-light-primary me-3">
                            <!--end::Svg Icon-->{{ __('site.export_by_choose') }}
                        </button>
                    </form>
                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-2">
                        </span>
                        <!--end::Svg Icon-->{{ __('site.export_by_date') }}
                    </button>
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
                    <div class="col-12 col-md-6">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">{{__('site.status')}}:</label>
                            <select class="form-select form-select-solid fw-bolder" name="status">
                                <option></option>
                                <option value="created" @if(request('status') == 'created') selected @endif> created</option>
                                <option value="receiver_at_hub" @if(request('status') == 'receiver_at_hub') selected @endif>receiver at hub</option>
                                <option value="out_for_delivery" @if(request('status') == 'out_for_delivery') selected @endif>out for delivery</option>
                                <option value="delivered" @if(request('status') == 'delivered') selected @endif>delivered</option>
                                <option value="onhold" @if(request('status') == 'onhold') selected @endif>on hold</option>
                                <option value="no_answer" @if(request('status') == 'no_answer') selected @endif>no_answer</option>
                                <option value="rejected" @if(request('status') == 'rejected') selected @endif>rejected</option>
                                <option value="rejected_fees_paid" @if(request('status') == 'rejected_fees_paid') selected @endif>rejected fees paid</option>

                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>
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
                            <label class="form-label fs-6 fw-bold">{{__('site.driver_settled')}}:</label>
                            <select class="form-select form-select-solid fw-bolder" name="driver_settled">
                                <option></option>
                                <option value="2" @if(request('driver_settled') == '2') selected @endif>{{ __('site.settled') }}</option>
                                <option value="1" @if(request('driver_settled') == '1') selected @endif>{{ __('site.not_settled') }}</option>

                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-10 mt-5">
                            <button class="btn btn-block w-100 btn-primary">{{ __('site.search') }}</button>
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
                    <th class="min-w-125px">{{__('site.receiver_name')}}</th>
                    <th class="min-w-125px">{{__('site.status')}}</th>
                    <th class="min-w-125px">{{__('site.driver_settled')}}</th>
                    <th class="min-w-125px">{{__('site.print')}}</th>
                    <th class="min-w-125px">{{__('site.phone')}}</th>
                    <th class="min-w-125px">{{__('site.address')}}</th>
                    <th class="min-w-125px">{{__('site.onhold')}}</th>
                    <th class="min-w-125px">{{__('site.price')}}</th>
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
                    <tr>
                        <!--begin::Checkbox-->
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" name="shippment[]" form="pdf" type="checkbox" value="{{$shipment->id}}" />
                            </div>
                        </td>
                        <!--end::Checkbox-->

                        <!--begin::User=-->
                        <td>
                            <form action="{{ route('scan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sometext" value="{{$shipment->barcode}}">
                                <button class="btn btn-secondary">{{$shipment->barcode}}</button>
                            </form>
                        </td>
                        <td>
                            {{ $shipment->shippment_type }}
                        </td>
                        <td>
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


                        @if ($shipment->status == 'receiver at hub')
                        <td>
                            <div class="rounded-pill" style="background-color: #94c1e2;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @elseif($shipment->status == 'out_for_delivery')
                        <td>
                            <div class="rounded-pill" style="background-color: #7bc1f3;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @elseif($shipment->status == 'delivered')
                        <td>
                            <div class="rounded-pill" style="background-color: #52ec7b;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @elseif($shipment->status == 'OnHold')
                        <td>
                            <div class="rounded-pill" style="background-color: #b9bc7f;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @elseif($shipment->status == 'no_answer')
                        <td>
                            <div class="rounded-pill" style="background-color: #bec35f;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @elseif($shipment->status == 'rejected')
                        <td>
                            <div class="rounded-pill" style="background-color: #ee83a5;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @elseif($shipment->status == 'rejected_fees_paid')
                        <td>
                            <div class="rounded-pill" style="background-color: #f16060;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @elseif($shipment->status == 'created')
                        <td>
                            <div class="rounded-pill" style="background-color: #b2cd94;text-align: center">
                                {{$shipment->status}}</div>
                        </td>
                        @else
                        <td>
                            <div class="rounded-pill" style="background-color: #cbcbcb;text-align: center">{{ $shipment->status }}</div>
                        </td>
                        @endif
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
                        <td>{{$shipment->created_at}}</td>
                        <td>{{$shipment->updated_at}}</td>

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


</script>


@endpush
