@extends('Dashboard.app')

@section('title',__('site.accountseller'))

@section('page_name',__('site.accountseller'))

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
        <a href="{{route('account.index')}}" class="text-muted text-hover-primary">{{__('site.accountseller')}}</a>
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
                <form method="get" action="{{route('accountseller_pdf')}}">
                    <div class="container">
                        <div class="row">
                            <label for="from" class="col-form-label">seller</label>
                            <div class="col-md-6">
                                <select id="user_id" name="user_id" class="form-select ">
                                    <option></option>
                                    @foreach ($users as $users )
                                    <option value="{{$users->id}}">{{$users->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="from" class="col-form-label">From</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control input-sm" id="from" name="from">
                            </div>
                            <label for="from" class="col-form-label">To</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control input-sm" id="to" name="to">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" id="button12" class="btn btn-secondary">export
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
                                {{-- <option value="picked up">picked up
                                </option>
                                <option value="receiver at hub">receiver at hub</option>
                                <option value="shipped">shipped</option> --}}
                                <option value="delivered">delivered</option>
                                {{-- <option value="no_answer">no_answer</option> --}}
                                <option value="rejected">rejected</option>
                                <option value="rejected_fees_faid">rejected_fees_faid</option>
                            </select>
                        </div>
                        <!--end::Input group-->

                        {{-- <div class="mb-10">
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
                        </div> --}}

                        {{-- <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">{{__('site.driver')}}:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                data-placeholder="Select option" data-allow-clear="true"
                                data-kt-user-table-filter="driver" data-hide-search="true">
                                <option></option>
                                @foreach ($shipment as $shipment)
                                <option value="{{$shipment->id}}">
                                    {{$shipment->id}}
                                </option>
                                @endforeach

                            </select>
                        </div> --}}

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

                <a href="{{route('ScheduleSeller.index')}}" class="btn btn-primary">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    {{-- <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                        </svg> --}}<i class="fa fa-file"></i>
                    </span>
                    <!--end::Svg Icon-->{{__('site.accountsfile')}}
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
                    <th class="min-w-125px">{{__('site.date')}}</th>
                    <th class="min-w-125px">{{__('site.status')}}</th>
                    <th class="min-w-125px">{{__('site.name')}}</th>
                    <th class="min-w-125px">{{__('site.phone')}}</th>
                    <th class="min-w-125px">{{__('site.city')}}</th>
                    <th class="min-w-125px">{{__('site.area')}}</th>
                    <th class="min-w-125px">{{__('site.cash')}}</th>
                    <th class="min-w-125px">{{__('site.area')}}</th>
                    <th class="min-w-125px">{{__('site.cost')}}</th>
                    {{-- <th class="text-end min-w-100px">Actions</th> --}}
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->

            <tbody class="text-gray-600 fw-bold">

                @foreach ($shipment as $shipment)
                <tr>
                    <!--begin::Checkbox-->
                    {{-- <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td> --}}
                    <!--end::Checkbox-->

                    <!--begin::User=-->
                    <td class="d-flex align-items-center">
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a class="text-gray-800 text-hover-primary mb-1 view_data" id="{{$shipment->shippment->id}}"
                                data-bs-toggle="modal" role="button">{{$shipment->shippment->id}}</a>
                            {{-- <a href="https://wa.me/{{$shipment->shippment->receiver_phone}}">
                                <i class="fa fa-user"></i>

                            </a>
                            <a id="phone_number" href="tel:+{{$shipment->shippment->receiver_phone}}">
                                <i class="fa fa-phone"></i>
                            </a> --}}

                        </div>
                        <!--begin::User details-->
                    </td>
                    <!--end::User=-->
                    <td>{{$shipment->shippment->created_at}}</td>
                    <td>{{$shipment->shippment->status}}</td>
                    {{-- <td>

                        <a href="{{route('print',$shipment->shippment->id)}}">
                            <i class="fa fa-print"></i>

                        </a>

                    </td> --}}
                    <td>{{$shipment->shippment->receiver_name}}</td>
                    <td>{{$shipment->shippment->receiver_phone}}</td>

                    {{-- <td>
                        <div class="badge badge-light fw-bolder">{{$shipment->shippment->address}}</div>
                    </td> --}}

                    <td>{{$shipment->shippment->city->city}}</td>

                    <td>{{$shipment->shippment->area->area}}</td>
                    <td>{{$shipment->cash}}</td>
                    {{-- @foreach ($shipment->shippment->user->specialprices as $item)

                    @if($item->special_price != 0 && $shipment->shippment->area->id == $item->area_id )
                    <td>{{$item->special_price}}</td>
                    @break
                    @else
                    <td>{{$shipment->shippment->area->rate}}</td>
                    @endif
                    @endforeach --}}
                    @if (!$shipment->shippment->area->specialprice)
                    <td>{{$shipment->shippment->area->rate}}</td>
                    @else
                    <td>{{$shipment->shippment->area->specialprice->special_price}}</td>

                    @endif

                    <td>{{$shipment->cost}}</td>

                    <!--begin::Action=-->
                    {{-- <td class="text-end">
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
                                <a href="{{route('shipment.show',$shipment->shippment->id)}}"
                                    class="menu-link px-3">show</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{route('shipment.edit',$shipment->shippment->id)}}"
                                    class="menu-link px-3">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" onclick="confirmDelete('{{$shipment->shippment->id}}',this)"
                                    class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td> --}}
                    <!--end::Action=-->
                    <td></td>

                </tr>

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

@section('js')

<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script>

<script>
    $(document).ready(function(){


    // Close modal on button click
        $("#button12").click(function(){
        $("#exampleModal").modal('hide');
        });
    });
</script>
@endsection
