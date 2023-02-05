@extends('Dashboard.app')

@section('title', __('site.accountseller'))

@section('page_name', __('site.accountseller'))

@section('pages')

    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('app') }}" class="text-muted text-hover-primary">{{ __('site.home') }}</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('account.index') }}" class="text-muted text-hover-primary">{{ __('site.accountseller') }}</a>
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
<form method="get" action="{{ route('accountseller_pdf') }}" id="accountseller_pdf">
</form>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">add the date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <label for="from" class="col-form-label">seller</label>

                            <div class="col-md-6">
                                <select id="seller_id" name="seller_id" class="form-select" form="accountseller_pdf">
                                    <option></option>
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="from" class="col-form-label">From</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control input-sm" id="from" name="from" form="accountseller_pdf">
                            </div>
                            <label for="from" class="col-form-label">To</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control input-sm" id="to" name="to" form="accountseller_pdf">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" id="button12" class="btn btn-secondary settled_btn" data-settled="export_date">export</button>
                            </div>
                        </div>
                    </div>
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
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    @if (Auth::guard('admin')->check() || Auth::guard('employee')->check())
                        <button class="btn btn-secondary settled_btn" style="margin-inline-end:10px" data-settled="extract">{{ __('site.extract') }}</button>
                        <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-bs-whatever="@mdo">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                            <span class="svg-icon svg-icon-2">
                            </span>
                            <!--end::Svg Icon-->{{ __('site.export') }}
                        </button>
                    @endif

                    <a href="{{ route('ScheduleSeller.index') }}" class="btn btn-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        {{-- <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                        </svg> --}}<i class="fa fa-file"></i>
                        </span>
                        <!--end::Svg Icon-->{{ __('site.settled_files') }}
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
            <div id="kt_view_search" class="collapse">
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <form method="GET">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{ __('site.settled_id') }}:</label>
                                    <input type="text" class="form-control" name="settled_id"
                                        value="{{ request('settled_id') }}">
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{ __('site.shippment_code') }}:</label>
                                    <input type="text" class="form-control" name="shippment_code"
                                        value="{{ request('shippment_code') }}">
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{ __('site.seller_settled') }}:</label>
                                    <select class="form-select form-select-solid fw-bolder" name="seller_settled">
                                        <option></option>
                                        <option value="2" @if (request('seller_settled') == '2') selected @endif>
                                            {{ __('site.settled') }}</option>
                                        <option value="1" @if (request('seller_settled') == '1') selected @endif>
                                            {{ __('site.not_settled') }}</option>

                                    </select>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{ __('site.shippment_type') }}:</label>
                                    <select class="form-select form-select-solid fw-bolder" name="shippment_type">
                                        <option></option>
                                        <option value="forward" @if (request('shippment_type') == 'forward') selected @endif>forward
                                        </option>
                                        <option value="exchange" @if (request('shippment_type') == 'exchange') selected @endif>exchange
                                        </option>
                                        <option value="cash_collection" @if (request('shippment_type') == 'cash_collection') selected @endif>
                                            cash_collection</option>
                                        <option value="return_pickup" @if (request('shippment_type') == 'return_pickup') selected @endif>
                                            return_pickup</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-6 fw-bold">{{ __('site.shippment_status') }}:</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                    data-placeholder="Select option" data-allow-clear="true" name="shippment_status"
                                    data-kt-user-table-filter="status" data-hide-search="true">
                                    <option></option>
                                    <option value="created" @if (request('shippment_status') == 'created') selected @endif> created
                                    </option>
                                    <option value="receiver_at_hub" @if (request('shippment_status') == 'receiver_at_hub') selected @endif>
                                        receiver at hub</option>
                                    <option value="out_for_delivery" @if (request('shippment_status') == 'out_for_delivery') selected @endif>out
                                        for delivery</option>
                                    <option value="delivered" @if (request('shippment_status') == 'delivered') selected @endif>delivered
                                    </option>
                                    <option value="onhold" @if (request('shippment_status') == 'onhold') selected @endif>on hold
                                    </option>
                                    <option value="no_answer" @if (request('shippment_status') == 'no_answer') selected @endif>no_answer
                                    </option>
                                    <option value="rejected" @if (request('shippment_status') == 'rejected') selected @endif>rejected
                                    </option>
                                    <option value="rejected_fees_paid" @if (request('shippment_status') == 'rejected_fees_paid') selected @endif>
                                        rejected fees paid</option>
                                    <option value="proccessing" @if (request('shippment_status') == 'proccessing') selected @endif>
                                        proccessing</option>
                                    <option value="pickedup" @if (request('shippment_status') == 'pickedup') selected @endif>picked up
                                    </option>

                                </select>
                            </div>
                            <div class="col-12">
                                <div class="mb-10 mt-5">
                                    <button class="btn btn-primary">{{ __('site.search') }}</button>
                                    <a href="{{ route('account.index') }}"
                                        class="btn btn-danger">{{ __('site.reset') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-user-table-toolbar="selected">
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
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input all_check" type="checkbox" />
                            </div>
                        </th>
                        <th class="min-w-115px">{{ __('site.id') }}</th>
                        <th class="min-w-115px">{{ __('site.shippment_barcode') }}</th>
                        <th class="min-w-125px">{{ __('site.seller') }}</th>
                        <th class="min-w-125px">{{ __('site.type') }}</th>
                        <th class="min-w-125px">{{ __('site.date') }}</th>
                        <th class="min-w-125px">{{ __('site.status') }}</th>
                        <th class="min-w-125px">{{ __('site.seller_settled') }}</th>
                        <th class="min-w-125px">{{ __('site.name') }}</th>
                        <th class="min-w-125px">{{ __('site.phone') }}</th>
                        <th class="min-w-125px">{{ __('site.city') }}</th>
                        <th class="min-w-120px">{{ __('site.area') }}</th>
                        <th class="min-w-120px">{{ __('site.cash') }}</th>
                        <th class="min-w-120px">{{ __('site.rate') }}</th>
                        <th class="min-w-120px">{{ __('site.cost') }}</th>
                        <th class="min-w-120px">{{ __('site.pickup_price') }}</th>
                        <th class="min-w-120px">{{ __('site.pure_price') }}</th>
                        {{-- <th class="text-end min-w-100px">Actions</th> --}}
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->

                <tbody class="text-gray-600 fw-bold">

                    @foreach ($accounts as $account)
                        @if ($account->shippment)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input check_input" name="shippment[]"  form="accountseller_pdf"
                                            type="checkbox" value="{{ $account->shippment->id }}" />
                                    </div>
                                </td>

                                <td>
                                    {{ $account->id }}
                                </td>
                                <td class="d-flex align-items-center">
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column">
                                        {{ $account->shippment->barcode }}
                                        {{-- <a class="text-gray-800 text-hover-primary mb-1 view_data" id="{{$account->id}}"
                                        href="{{route('account.show',$account->shippment->id)}}"
                                        >{{ $account->shippment_id }}</a> --}}
                                    </div>
                                    <!--begin::User details-->
                                </td>
                                <!--end::User=-->
                                <td>{{ $account->user->name }}</td>
                                <td>{{ __('site.shipment') . '-' . $account->shippment->shippment_type }}</td>
                                <td>{{ $account->created_at }}</td>
                                <td>
                                    {{ $account->shippment->status }}<br>
                                    {{ $account->shippment->rejected_fees_paid }}
                                </td>
                                <td>
                                    @if ($account->shippment->seller_settled)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times"></i>
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $account->shippment->receiver_name }}</td>
                                <td>{{ $account->shippment->receiver_phone }}</td>

                                <td>{{ $account->shippment->city->city }}</td>

                                <td>{{ $account->shippment->area->area }}</td>
                                <td>{{ $account->cash }}</td>
                                <td>-{{ $account->rate }}</td>

                                <td>{{ $account->cost }}</td>
                                <td>--</td>
                                <td>{{ $account->cost }}</td>

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

                            </tr>
                        @else
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input check_input" name="pickup[]"  form="accountseller_pdf"
                                            type="checkbox" value="{{ $account->pickup->id }}" />
                                    </div>
                                </td>
                                <!--begin::User=-->
                                <td class="d-flex align-items-center">
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column">
                                        <a class="text-gray-800 text-hover-primary mb-1 view_data"
                                            id="{{ $account->id }}"
                                            href="{{ route('account.show', $account->pickup->id) }}">{{ $account->pickup->id }}</a>
                                    </div>
                                    <!--begin::User details-->
                                </td>
                                <!--end::User=-->
                                <td>{{ $account->user->name }}</td>
                                <td>{{ __('site.pickup') }}</td>

                                <td>{{ $account->created_at }}</td>
                                <td>{{ $account->pickup->status }}</td>
                                <td>
                                    @if ($account->pickup->seller_settled)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times"></i>
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $account->pickup->name }}</td>
                                <td>{{ $account->pickup->phone }}</td>

                                <td>{{ $account->pickup->address->city->city }}</td>

                                <td>{{ $account->pickup->address->area->area }}</td>
                                <td>--</td>
                                <td>--</td>

                                <td>--</td>
                                <td>{{ -$account->seller_commission }}</td>
                                <td>{{ -$account->seller_commission }}</td>
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

                            </tr>
                        @endif
                    @endforeach

                </tbody>
                <!--end::Table body-->
            </table>
            {{ $accounts->links() }}
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

@endsection

@section('js')

    {{-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script> --}}

    <script>
        $(document).ready(function() {

            // Close modal on button click
            $("#button12").click(function() {
                $("#exampleModal").modal('hide');
            });
        });


        $(".all_check").on('click', function() {
            $("input[name='shippment[]']").click();
        });

        $(".settled_btn").on('click', function() {
            $("#accountseller_pdf").append(`<input type='hidden' name='type' value='${$(this).data('settled')}'>`)
            $("#accountseller_pdf").submit();
        });


    </script>
@endsection
