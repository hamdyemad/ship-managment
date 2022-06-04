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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path
                                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg>
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
