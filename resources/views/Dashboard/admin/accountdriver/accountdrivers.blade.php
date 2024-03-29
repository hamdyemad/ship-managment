@extends('Dashboard.app')

@section('title',__('site.accountdriver'))

@section('page_name',__('site.accountdriver'))

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
        <a href="{{route('shipments_drivers')}}" class="text-muted text-hover-primary">{{__('site.accountdriver')}}</a>
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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        {{-- @foreach ($errors->all() as $error) --}}
        <li>{{ $error }}</li>
        {{-- @endforeach --}}
    </ul>
</div>
@endif
<form action="{{route('account_driver')}}" method="get" enctype="multipart/form-data" id="account_driver_pdf">
    @csrf
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
                        <label for="from" class="col-form-label">driver</label>
                        <div class="col-md-6">
                            <select id="driver_id" name="driver_id" class="form-select" form="account_driver_pdf">
                                <option></option>
                                @foreach ($drivers as $drivers )
                                    <option value="{{$drivers->id}}">{{$drivers->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="from" class="col-form-label">From</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control input-sm" id="from" name="from" form="account_driver_pdf">
                        </div>
                        <label for="from" class="col-form-label">To</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control input-sm" id="to" name="to" form="account_driver_pdf">
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-secondary btn-sm settled_btn" data-settled="export_date">export</button>
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
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                    <button class="btn btn-secondary settled_btn" style="margin-inline-end:10px" data-settled="extract">{{ __('site.extract') }}</button>
                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-2">
                        </span>
                        <!--end::Svg Icon-->Export
                    </button>
                @endif
                <!--begin::Add shipment-->

                <a href="{{route('Scheduledriver.index')}}" class="btn btn-primary">
                    <i class="fa fa-file"></i>
                    {{__('site.settled_files')}}
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
                                    <label class="form-label fs-6 fw-bold">{{__('site.settled_id')}}:</label>
                                    <input type="text" class="form-control" name="settled_id" value="{{ request('settled_id') }}">
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-12 col-md-6">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.shippment_code')}}:</label>
                                    <input type="text" class="form-control" name="shippment_code" value="{{ request('shippment_code') }}">
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
                            <div class="col-12">
                                <label class="form-label fs-6 fw-bold">{{__('site.shippment_status')}}:</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                    data-placeholder="Select option" data-allow-clear="true"
                                    name="shippment_status"
                                    data-kt-user-table-filter="status" data-hide-search="true">
                                    <option></option>
                                    <option value="created" @if(request('shippment_status') == 'created') selected @endif> created</option>
                                    <option value="receiver_at_hub" @if(request('shippment_status') == 'receiver_at_hub') selected @endif>receiver at hub</option>
                                    <option value="out_for_delivery" @if(request('shippment_status') == 'out_for_delivery') selected @endif>out for delivery</option>
                                    <option value="delivered" @if(request('shippment_status') == 'delivered') selected @endif>delivered</option>
                                    <option value="onhold" @if(request('shippment_status') == 'onhold') selected @endif>on hold</option>
                                    <option value="no_answer" @if(request('shippment_status') == 'no_answer') selected @endif>no_answer</option>
                                    <option value="rejected" @if(request('shippment_status') == 'rejected') selected @endif>rejected</option>
                                    <option value="rejected_fees_paid" @if(request('shippment_status') == 'rejected_fees_paid') selected @endif>rejected fees paid</option>
                                    <option value="proccessing" @if(request('shippment_status') == 'proccessing') selected @endif>proccessing</option>
                                    <option value="pickedup" @if(request('shippment_status') == 'pickedup') selected @endif>picked up</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="mb-10 mt-5">
                                    <button class="btn btn-primary">{{ __('site.search') }}</button>
                                    <a href="{{ route('shipments_drivers') }}" class="btn btn-danger">{{ __('site.reset') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>

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
                    <th class="min-w-115px">{{__('site.id')}}</th>
                    <th>{{__('site.shippment_barcode')}}</th>
                    <th class="min-w-125px">{{__('site.type')}}</th>
                    <th class="min-w-125px">{{__('site.driver')}}</th>
                    <th class="min-w-125px">{{__('site.status')}}</th>
                    <th class="min-w-125px">{{__('site.settled')}}</th>
                    <th class="min-w-125px">{{__('site.shippername')}}</th>
                    <th class="min-w-125px">{{__('site.shipperphone')}}</th>
                    <th class="min-w-125px">{{__('site.name')}}</th>
                    <th class="min-w-125px">{{__('site.phone')}}</th>
                    <th class="min-w-125px">{{__('site.city')}}</th>
                    <th class="min-w-125px">{{__('site.area')}}</th>
                    <th class="min-w-120px">{{__('site.cash')}}</th>
                    <th class="min-w-120px">{{__('site.rate')}}</th>
                    <th class="min-w-120px">{{__('site.cost')}}</th>
                    <th class="min-w-120px">{{__('site.pickup_price')}}</th>
                    <th class="min-w-120px">{{__('site.created_at')}}</th>
                    <th class="min-w-120px">{{__('site.updated_at')}}</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->

            <tbody class="text-gray-600 fw-bold">

                @foreach ($accounts as $account)
                    @if ($account->pickup==null)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input check_input" name="shippment[]"  form="account_driver_pdf"
                                        type="checkbox" value="{{ $account->shippment->id }}" />
                                </div>
                            </td>
                            <td>
                                {{ $account->id }}
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a class="text-gray-800 text-hover-primary mb-1 view_data" id="{{$account->id}}"
                                        href="{{route('shipment.show',$account->shippment->id)}}">{{$account->shippment->barcode}}</a>
                                </div>
                            </td>
                            <td>{{ __("site.shipment") . '-' . $account->shippment->shippment_type }}</td>


                            <!--end::User=-->
                            <td>
                                @if($account->shippment->deliveries->count() > 0)
                                    {{ $account->shippment->deliveries[0]->driver->name }}
                                @endif
                            </td>
                            <td>
                                {{$account->shippment->status}}<br>
                                @if($account->shippment->rejected_fees_paid)
                                    <span class="badge badge-secondary d-block">
                                        {{ $account->shippment->rejected_fees_paid }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($account->shippment->driver_settled)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{$account->shippment->user->name}}</td>
                            <td>{{$account->shippment->user->phone}}</td>

                            <td>{{$account->shippment->receiver_name}}</td>
                            <td>{{$account->shippment->receiver_phone}}</td>


                            <td>{{$account->shippment->city->city}}</td>

                            <td>{{$account->shippment->area->area}}</td>
                            <td>{{$account->cash}}</td>
                            <td>{{-$account->rate}}</td>
                            <td>{{$account->cost}}</td>
                            <td>{{ $account->delivery_commission }}</td>

                            <td>{{ $account->created_at }}</td>
                            <td>{{ $account->updated_at }}</td>
                            {{-- @endif --}}

                            <td></td>

                        </tr>
                    @else
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input check_input" name="pickup[]"  form="account_driver_pdf"
                                        type="checkbox" value="{{ $account->pickup->id }}" />
                                </div>
                            </td>

                            <!--begin::User=-->
                            <td class="d-flex align-items-center">
                                <!--begin::User details-->
                                <div class="d-flex flex-column">
                                    {{-- <a class="text-gray-800 text-hover-primary mb-1 view_data" id="" data-bs-toggle="modal"
                                        role="button"></a> --}}
                                    <a class="text-gray-800 text-hover-primary mb-1 view_data" id="{{$account->id}}"
                                        href="{{route('pickup.show',$account->pickup->id)}}">{{$account->pickup->id}}</a>

                                </div>
                                <!--begin::User details-->
                            </td>
                            <td>{{ __("site.pickup") }}</td>

                            <!--end::User=-->
                            <td>{{ $account->pickup->deliveries[0]->driver->name }}</td>
                            <td>{{$account->pickup->status}}</td>
                            <td>
                                @if($account->pickup->driver_settled)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{$account->pickup->user->name}}</td>
                            <td>{{$account->pickup->user->phone}}</td>
                            <td>{{$account->pickup->name}}</td>
                            <td>{{$account->pickup->phone}}</td>

                            <td>{{$account->pickup->address->city->city}}</td>

                            <td>{{$account->pickup->address->area->area}}</td>
                            <td>--</td>
                            <td>--</td>

                            {{-- @if($account->shippment->user->special_price != 0 && $account->shippment->city->id ==
                            $account->shippment->user->city_id &&
                            $account->shippment->area->id == $account->shippment->user->area_id)

                            <td>{{$account->shippment->user->special_price}}</td>
                            @else
                            <td>{{$account->shippment->area->rate}}</td>
                            @endif --}}
                            <td>--</td>
                            <td>{{ $account->delivery_commission }}</td>

                            <td>{{ $account->created_at }}</td>
                            <td>{{ $account->updated_at }}</td>

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
                    @endif
                @endforeach
                {{-- {{dd($shipment)}} --}}
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



    $(".all_check").on('click', function() {
        $("input[name='shippment[]']").click();
    });

    $(".settled_btn").on('click', function() {
        $("#account_driver_pdf").append(`<input type='hidden' name='type' value='${$(this).data('settled')}'>`)
        $("#account_driver_pdf").submit();
    });



</script>


@endpush
