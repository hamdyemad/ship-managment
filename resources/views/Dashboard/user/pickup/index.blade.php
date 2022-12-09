@extends('Dashboard.app')

@section('title',__('site.pickup'))

@section('page_name',__('site.pickup'))

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
        <a href="" class="text-muted text-hover-primary">{{__('site.pickup')}}</a>
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
                <form action="ViewPages" method="POST" enctype="multipart/form-data">
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
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                    <a href="{{route('pickup.create')}}" class="btn btn-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{__('site.add_pickup')}}
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

        </div>
    </div>
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div id="kt_view_search" class="collapse">
            <form method="GET">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">{{__('site.status')}}:</label>
                            <select class="form-select form-select-solid fw-bolder" name="status">
                                <option></option>
                                <option value="requested" @if(request('status') == 'requested') selected @endif>requested</option>
                                <option value="proccessing" @if(request('status') == 'proccessing') selected @endif>proccessing</option>
                                <option value="pickedup" @if(request('status') == 'pickedup') selected @endif>picked up</option>
                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-12 col-md-6">
                        <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">{{__('site.driver')}}:</label>
                                <select class="form-select form-select-solid fw-bolder" name="driver_id">
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
                                <label class="form-label fs-6 fw-bold">{{__('site.seller_settled')}}:</label>
                                <select class="form-select form-select-solid fw-bolder" name="seller_settled">
                                    <option></option>
                                    <option value="2" @if(request('seller_settled') == '2') selected @endif>settled</option>
                                    <option value="1" @if(request('seller_settled') == '1') selected @endif>not settled</option>
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
                                    <option value="2" @if(request('driver_settled') == '2') selected @endif>settled</option>
                                    <option value="1" @if(request('driver_settled') == '1') selected @endif>not settled</option>
                                </select>
                            </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-12">
                        <div class="mb-10 mt-5">
                            <button class="btn btn-primary">{{ __('site.search') }}</button>
                            <a href="{{ route('pickup.index') }}" class="btn btn-danger">{{ __('site.reset') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                    <th class="min-w-125px">{{__('site.pickupid')}}</th>
                    <th class="min-w-125px">{{__('site.driver')}}</th>
                    <th class="min-w-125px">{{__('site.seller_settled')}}</th>
                    <th class="min-w-125px">{{__('site.driver_settled')}}</th>
                    <th class="min-w-125px">{{__('site.status')}}</th>
                    <th class="min-w-125px">{{__('site.packages')}}</th>
                    <th class="min-w-125px">{{__('site.pickupdate')}}</th>
                    <th class="min-w-125px">{{__('site.user')}}</th>
                    <th class="min-w-125px">{{__('site.phone')}}</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->

            <tbody class="text-gray-600 fw-bold">

                @foreach ($pickups as $pickup)
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
                            {{-- <a class="text-gray-800 text-hover-primary mb-1 view_data" id="{{$pickup->id}}"
                                data-bs-toggle="modal" role="button">{{$pickup->id}}</a> --}}
                            <a class="text-gray-800 text-hover-primary mb-1 view_data"
                                href="{{route('pickup.show',$pickup->id)}}">{{$pickup->id}}</a>

                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>
                        @foreach ($pickup->deliveries as $delivery)
                            {{ $delivery->driver->name }}<br>
                            {{ $delivery->driver->phone }}<br>
                        @endforeach
                    </td>
                    <td>
                        @if($pickup->seller_settled)
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
                        @if($pickup->driver_settled)
                            <span class="badge badge-success">
                                <i class="fas fa-check"></i>
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times"></i>
                            </span>
                        @endif
                    </td>
                    <!--end::User=-->
                    {{-- @foreach ($shipment as $shipment)
                    --}}
                    {{-- @if ($shipment->id == $pickup->shipment_id)
                    <td>{{$shipment->status}}</td>
                    @endif --}}

                    {{-- @endforeach --}}

                    <td>
                        @if ($pickup->status == 'pickedup')
                            <div class="rounded-pill" style="background-color: #94c1e2;width: 80%;text-align: center">
                                {{$pickup->status}}</div>
                        @elseif($pickup->status == 'requested')
                            <div class="rounded-pill" style="background-color: #7bc1f3;width: 80%;text-align: center">
                                {{$pickup->status}}</div>
                        @elseif($pickup->status == 'proccessing')
                            <div class="rounded-pill" style="background-color: #52ec7b;width: 80%;text-align: center">
                                {{$pickup->status}}</div>
                        @endif
                    </td>
                    <td>{{ $pickup->package }}</td>

                    <td>{{$pickup->date}}</td>

                    <td>
                        <div class="badge badge-light fw-bolder">{{$pickup->name}}</div>
                    </td>


                    <td>{{$pickup->phone}}</td>

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
                                <a href="{{route('pickup.show',$pickup->id)}}" class="menu-link px-3">show</a>
                            </div>
                            {{-- <div class="menu-item px-3">
                                <a href="{{route('shipment.edit',$pickup->id)}}" class="menu-link px-3">Edit</a>
                            </div> --}}
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            {{-- <div class="menu-item px-3">
                                <a href="#" onclick="confirmDelete('{{$pickup->id}}',this)" class="menu-link px-3"
                                    data-kt-users-table-filter="delete_row">Delete</a>
                            </div> --}}
                            <!--end::Menu item-->
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
