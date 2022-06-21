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
        <a href="" class="text-muted text-hover-primary">{{__('site.shipment')}}</a>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')
<style>
    @media screen {
        #phone_number {
            display: none;
        }
    }

    /* On screens that are 600px wide or less, the background color is olive */
    @media screen and (max-width: 912px)and (min-width:200px) {
        #phone_number {
            display: inherit;
        }
    }
</style>
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
                <form action="{{route('pdfallshippments')}}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
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
                                <button type="submit" class="btn btn-secondary btn-sm" name="exportPDF">export
                                    PDF</button>
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
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-user-table-filter="search"
                    class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <!--begin::Filter-->
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Filter
                </button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->
                    <div class="px-7 py-5" data-kt-user-table-filter="form">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">{{__('site.status')}}:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                data-placeholder="Select option" data-allow-clear="true"
                                data-kt-user-table-filter="status" data-hide-search="true">
                                <option></option>
                                <option value="picked up">picked up
                                </option>
                                <option value="receiver at hub">receiver at hub</option>
                                <option value="shipped">shipped</option>
                                <option value="delivered">delivered</option>
                                <option value="no_answer">no_answer</option>
                                <option value="rejected">rejected</option>
                                <option value="rejected_fees_faid">rejected_fees_faid</option>
                            </select>
                        </div>
                        <!--end::Input group-->

                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">{{__('site.type')}}:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                data-placeholder="Select option" data-allow-clear="true"
                                data-kt-user-table-filter="type" data-hide-search="true">
                                <option></option>
                                <option value="forward">Forward
                                </option>
                                <option value="exchange">exchange</option>
                                <option value="cash_collection">cash collection</option>

                            </select>
                        </div>

                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">{{__('site.driver')}}:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                data-placeholder="Select option" data-allow-clear="true"
                                data-kt-user-table-filter="driver" data-hide-search="true">
                                <option></option>
                                @foreach ($driver as $driver)
                                <option value="{{$driver->name}}">
                                    {{$driver->name}}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6"
                                data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true"
                                data-kt-user-table-filter="filter">Apply</button>
                        </div>
                        <!--end::Actions-->

                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->

                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="@mdo">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-2">
                    </span>
                    <!--end::Svg Icon-->Export
                </button>
                <a href="{{route('export_shippment')}}" class="btn btn-light-primary me-3">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-2">
                    </span>
                    <!--end::Svg Icon-->Export2
                </a>
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

            </div>
            <!--end::Toolbar-->
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
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th style="display: none" class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">{{__('site.id')}}</th>
                    <th class="min-w-125px">{{__('site.user')}}</th>
                    <th class="min-w-125px">{{__('site.status')}}</th>
                    <th class="min-w-125px">{{__('site.print')}}</th>
                    <th class="min-w-125px">{{__('site.type')}}</th>
                    <th class="min-w-125px">{{__('site.phone')}}</th>
                    <th class="min-w-125px">{{__('site.address')}}</th>
                    <th class="min-w-125px">Settled</th>
                    <th class="min-w-125px">{{__('site.traching')}}</th>
                    <th class="min-w-125px">{{__('site.onhold')}}</th>
                    <th class="min-w-125px">{{__('site.driver')}}</th>
                    <th class="min-w-125px">{{__('site.price')}}</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->

            <tbody class="text-gray-600 fw-bold">

                @foreach ($delivery as $delivery)
                @if ($delivery->pickup_id == null)
                <tr>
                    <!--begin::Checkbox-->
                    {{-- <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td> --}}
                    <!--end::Checkbox-->

                    <!--begin::User=-->
                    <td><a class="text-gray-800 text-hover-primary mb-1 view_data"
                            href="{{route('shipment.show',$delivery->shippment->id)}}">{{$delivery->id}}</a></td>
                    <td class="d-flex align-items-center">
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a class="text-gray-800 text-hover-primary mb-1 view_data" id="" data-bs-toggle="modal"
                                role="button">{{$delivery->shippment->user->name}}</a>
                            <a href="https://wa.me/{{$delivery->shippment->user->phone}}">
                                {{-- <i class="fa fa-user"></i> --}}
                                <span class="svg-icon svg-icon-1">
                                    <img style="width: 30px" alt="svgImg"
                                        src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iNDgiIGhlaWdodD0iNDgiCnZpZXdCb3g9IjAgMCA0OCA0OCIKc3R5bGU9IiBmaWxsOiN1bmRlZmluZWQ7Ij48cGF0aCBmaWxsPSIjZmZmIiBkPSJNNC44NjgsNDMuMzAzbDIuNjk0LTkuODM1QzUuOSwzMC41OSw1LjAyNiwyNy4zMjQsNS4wMjcsMjMuOTc5QzUuMDMyLDEzLjUxNCwxMy41NDgsNSwyNC4wMTQsNWM1LjA3OSwwLjAwMiw5Ljg0NSwxLjk3OSwxMy40Myw1LjU2NmMzLjU4NCwzLjU4OCw1LjU1OCw4LjM1Niw1LjU1NiwxMy40MjhjLTAuMDA0LDEwLjQ2NS04LjUyMiwxOC45OC0xOC45ODYsMTguOThjLTAuMDAxLDAsMCwwLDAsMGgtMC4wMDhjLTMuMTc3LTAuMDAxLTYuMy0wLjc5OC05LjA3My0yLjMxMUw0Ljg2OCw0My4zMDN6Ij48L3BhdGg+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTQuODY4LDQzLjgwM2MtMC4xMzIsMC0wLjI2LTAuMDUyLTAuMzU1LTAuMTQ4Yy0wLjEyNS0wLjEyNy0wLjE3NC0wLjMxMi0wLjEyNy0wLjQ4M2wyLjYzOS05LjYzNmMtMS42MzYtMi45MDYtMi40OTktNi4yMDYtMi40OTctOS41NTZDNC41MzIsMTMuMjM4LDEzLjI3Myw0LjUsMjQuMDE0LDQuNWM1LjIxLDAuMDAyLDEwLjEwNSwyLjAzMSwxMy43ODQsNS43MTNjMy42NzksMy42ODMsNS43MDQsOC41NzcsNS43MDIsMTMuNzgxYy0wLjAwNCwxMC43NDEtOC43NDYsMTkuNDgtMTkuNDg2LDE5LjQ4Yy0zLjE4OS0wLjAwMS02LjM0NC0wLjc4OC05LjE0NC0yLjI3N2wtOS44NzUsMi41ODlDNC45NTMsNDMuNzk4LDQuOTExLDQzLjgwMyw0Ljg2OCw0My44MDN6Ij48L3BhdGg+PHBhdGggZmlsbD0iI2NmZDhkYyIgZD0iTTI0LjAxNCw1YzUuMDc5LDAuMDAyLDkuODQ1LDEuOTc5LDEzLjQzLDUuNTY2YzMuNTg0LDMuNTg4LDUuNTU4LDguMzU2LDUuNTU2LDEzLjQyOGMtMC4wMDQsMTAuNDY1LTguNTIyLDE4Ljk4LTE4Ljk4NiwxOC45OGgtMC4wMDhjLTMuMTc3LTAuMDAxLTYuMy0wLjc5OC05LjA3My0yLjMxMUw0Ljg2OCw0My4zMDNsMi42OTQtOS44MzVDNS45LDMwLjU5LDUuMDI2LDI3LjMyNCw1LjAyNywyMy45NzlDNS4wMzIsMTMuNTE0LDEzLjU0OCw1LDI0LjAxNCw1IE0yNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0IE0yNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0QzI0LjAxNCw0Mi45NzQsMjQuMDE0LDQyLjk3NCwyNC4wMTQsNDIuOTc0IE0yNC4wMTQsNEMyNC4wMTQsNCwyNC4wMTQsNCwyNC4wMTQsNEMxMi45OTgsNCw0LjAzMiwxMi45NjIsNC4wMjcsMjMuOTc5Yy0wLjAwMSwzLjM2NywwLjg0OSw2LjY4NSwyLjQ2MSw5LjYyMmwtMi41ODUsOS40MzljLTAuMDk0LDAuMzQ1LDAuMDAyLDAuNzEzLDAuMjU0LDAuOTY3YzAuMTksMC4xOTIsMC40NDcsMC4yOTcsMC43MTEsMC4yOTdjMC4wODUsMCwwLjE3LTAuMDExLDAuMjU0LTAuMDMzbDkuNjg3LTIuNTRjMi44MjgsMS40NjgsNS45OTgsMi4yNDMsOS4xOTcsMi4yNDRjMTEuMDI0LDAsMTkuOTktOC45NjMsMTkuOTk1LTE5Ljk4YzAuMDAyLTUuMzM5LTIuMDc1LTEwLjM1OS01Ljg0OC0xNC4xMzVDMzQuMzc4LDYuMDgzLDI5LjM1Nyw0LjAwMiwyNC4wMTQsNEwyNC4wMTQsNHoiPjwvcGF0aD48cGF0aCBmaWxsPSIjNDBjMzUxIiBkPSJNMzUuMTc2LDEyLjgzMmMtMi45OC0yLjk4Mi02Ljk0MS00LjYyNS0xMS4xNTctNC42MjZjLTguNzA0LDAtMTUuNzgzLDcuMDc2LTE1Ljc4NywxNS43NzRjLTAuMDAxLDIuOTgxLDAuODMzLDUuODgzLDIuNDEzLDguMzk2bDAuMzc2LDAuNTk3bC0xLjU5NSw1LjgyMWw1Ljk3My0xLjU2NmwwLjU3NywwLjM0MmMyLjQyMiwxLjQzOCw1LjIsMi4xOTgsOC4wMzIsMi4xOTloMC4wMDZjOC42OTgsMCwxNS43NzctNy4wNzcsMTUuNzgtMTUuNzc2QzM5Ljc5NSwxOS43NzgsMzguMTU2LDE1LjgxNCwzNS4xNzYsMTIuODMyeiI+PC9wYXRoPjxwYXRoIGZpbGw9IiNmZmYiIGZpbGwtcnVsZT0iZXZlbm9kZCIgZD0iTTE5LjI2OCwxNi4wNDVjLTAuMzU1LTAuNzktMC43MjktMC44MDYtMS4wNjgtMC44MmMtMC4yNzctMC4wMTItMC41OTMtMC4wMTEtMC45MDktMC4wMTFjLTAuMzE2LDAtMC44MywwLjExOS0xLjI2NSwwLjU5NGMtMC40MzUsMC40NzUtMS42NjEsMS42MjItMS42NjEsMy45NTZjMCwyLjMzNCwxLjcsNC41OSwxLjkzNyw0LjkwNmMwLjIzNywwLjMxNiwzLjI4Miw1LjI1OSw4LjEwNCw3LjE2MWM0LjAwNywxLjU4LDQuODIzLDEuMjY2LDUuNjkzLDEuMTg3YzAuODctMC4wNzksMi44MDctMS4xNDcsMy4yMDItMi4yNTVjMC4zOTUtMS4xMDgsMC4zOTUtMi4wNTcsMC4yNzctMi4yNTVjLTAuMTE5LTAuMTk4LTAuNDM1LTAuMzE2LTAuOTA5LTAuNTU0cy0yLjgwNy0xLjM4NS0zLjI0Mi0xLjU0M2MtMC40MzUtMC4xNTgtMC43NTEtMC4yMzctMS4wNjgsMC4yMzhjLTAuMzE2LDAuNDc0LTEuMjI1LDEuNTQzLTEuNTAyLDEuODU5Yy0wLjI3NywwLjMxNy0wLjU1NCwwLjM1Ny0xLjAyOCwwLjExOWMtMC40NzQtMC4yMzgtMi4wMDItMC43MzgtMy44MTUtMi4zNTRjLTEuNDEtMS4yNTctMi4zNjItMi44MS0yLjYzOS0zLjI4NWMtMC4yNzctMC40NzQtMC4wMy0wLjczMSwwLjIwOC0wLjk2OGMwLjIxMy0wLjIxMywwLjQ3NC0wLjU1NCwwLjcxMi0wLjgzMWMwLjIzNy0wLjI3NywwLjMxNi0wLjQ3NSwwLjQ3NC0wLjc5MWMwLjE1OC0wLjMxNywwLjA3OS0wLjU5NC0wLjA0LTAuODMxQzIwLjYxMiwxOS4zMjksMTkuNjksMTYuOTgzLDE5LjI2OCwxNi4wNDV6IiBjbGlwLXJ1bGU9ImV2ZW5vZGQiPjwvcGF0aD48L3N2Zz4=" />
                                </span>

                            </a>
                            {{-- <a id="phone_number" href="tel:+{{$shipment->shippment->receiver_phone}}">
                                <i class="fa fa-phone"></i>
                            </a> --}}





                        </div>
                        <!--begin::User details-->
                    </td>
                    <!--end::User=-->

                    <td>{{$delivery->shippment->status}}</td>
                    <td>
                        {{-- <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"> --}}
                                <a href="{{route('print',$delivery->shippment->id)}}">
                                    <i class="fa fa-print"></i>
                                    {{-- {{__('site.export')}} --}}
                                </a>
                                {{--
                            </div>
                        </div> --}}
                    </td>
                    <td>{{$delivery->shippment->shippment_type}}</td>
                    <td>{{$delivery->shippment->receiver_phone}}</td>

                    <td>
                        <div class="badge badge-light fw-bolder">{{$delivery->shippment->address}}</div>
                    </td>
                    <td>
                        <div class="badge badge-light fw-bolder"><i class="bi bi-check-circle"
                                style="color: rgb(68, 204, 68)"></i></div>
                    </td>
                    <td>{{$delivery->shippment->barcode}}</td>
                    @if ($delivery->shippment->on_hold == null)
                    <td>--</td>
                    @else
                    <td>{{$delivery->shippment->on_hold}}</td>
                    @endif

                    <td>{{$delivery->driver->name}}</td>

                    <td>{{$delivery->shippment->price}}</td>

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
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="{{route('getshipmentstatusid',$delivery->shippment->id)}}"
                                    class="menu-link px-3">show</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{route('shipment.edit',$delivery->shippment->id)}}"
                                    class="menu-link px-3">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            {{-- <div class="menu-item px-3">
                                <a href="#" onclick="confirmDelete('{{$delivery->shippment->id}}',this)"
                                    class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                            </div> --}}
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                    <!--end::Action=-->
                    <td></td>

                </tr>
                @endif
                @endforeach
                {{-- {{dd($shipment)}} --}}

            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
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
    // message to confirm delete
    function confirmDelete(id,reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            performDelete(id,reference);
            }
        });
    }
    // delete shipment
    function performDelete(id,reference) {
        axios.delete('/dashboard/shipment/'+id)
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
            reference.closest('tr').remove();
            location.reload();
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
            })
        });
    }

</script>


@endpush
