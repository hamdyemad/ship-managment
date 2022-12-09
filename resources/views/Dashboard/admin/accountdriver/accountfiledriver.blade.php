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

{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add the date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('accountseller_pdf')}}" method="get" enctype="multipart/form-data">
                    @csrf
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
                                <button type="submit" class="btn btn-secondary btn-sm" name="exportPDF">export
                                    PDF</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> --}}

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
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">{{__('site.schedule_id')}}:</label>
                                    <input type="text" class="form-control" name="schedule_id" value="{{ request('schedule_id') }}">
                                </div>
                            </div>
                            @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                                <div class="col-12 col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">{{__('site.driver')}}:</label>
                                        <select class="form-select form-select-solid fw-bolder" name="driver_id">
                                            <option></option>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}" @if(request('driver_id') == $driver->id) selected @endif>{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="mb-10">
                                    <button class="btn btn-primary">{{ __('site.search') }}</button>
                                    <a href="{{ route('Scheduledriver.index') }}" class="btn btn-danger">{{ __('site.reset') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <!--end::Card toolbar-->
        </div>
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed">
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
                    <th class="min-w-125px">{{__('site.name')}}</th>
                    <th class="min-w-125px">{{__('site.from')}}</th>
                    <th class="min-w-125px">{{__('site.to')}}</th>
                    <th class="min-w-125px">{{__('site.cost')}}</th>
                    <th class="min-w-125px">{{__('site.pickup_price')}}</th>
                    <th class="min-w-125px">{{__('site.pdf')}}</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->

            <tbody class="text-gray-600 fw-bold">

                @foreach ($schedules as $schedule)
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
                            <a class="text-gray-800 text-hover-primary mb-1 view_data" id="{{$schedule->id}}"
                                data-bs-toggle="modal" role="button">{{$schedule->id}}</a>


                        </div>
                        <!--begin::User details-->
                    </td>
                    <!--end::User=-->
                    <td>{{$schedule->driver->name}}</td>
                    <td>{{$schedule->from}}</td>

                    <td>{{$schedule->to}}</td>
                    <td>{{$schedule->total_cost}}</td>
                    <td>{{$schedule->total_delivery_commission}}</td>
                    <td>
                        {{-- <a href="" onclick="addseller()">pdf</a>
                        --}}
                        <form action="{{route('accountdriver_pdf')}}" method="get" enctype="multipart/form-data">
                            @csrf
                            <div style="display: none">
                                <input type="text" name="schedule_id" value="{{$schedule->id}}">
                            </div>
                            <button type="submit" class="btn btn-light-primary me-3"><i class="fa fa-file"></i></button>
                        </form>
                    </td>


                    <td></td>

                </tr>

                @endforeach
                {{-- {{dd($shipment)}} --}}

            </tbody>
            <!--end::Table body-->
        </table>
        {{ $schedules->links() }}
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

@endsection
