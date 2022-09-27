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
                    <th class="min-w-125px">{{__('site.name')}}</th>
                    <th class="min-w-125px">{{__('site.from')}}</th>
                    <th class="min-w-125px">{{__('site.to')}}</th>
                    <th class="min-w-125px">{{__('site.price')}}</th>
                    <th class="min-w-125px">{{__('site.additional_price')}}</th>
                    <th class="min-w-125px">{{__('site.cost')}}</th>
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
                    <td>{{$schedule->user->name ?? 'None'}}</td>
                    <td>{{$schedule->from}}</td>

                    <td>{{$schedule->to}}</td>
                    <td>{{$schedule->price}}</td>
                    <td>{{$schedule->additional_price}}</td>
                    <td>{{$schedule->costs}}</td>
                    <td>
                        {{-- <a href="" onclick="addseller()">pdf</a>
                        --}}
                        <form action="{{route('Scheduleseller_pdf')}}" method="get" enctype="multipart/form-data">
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

{{-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script> --}}

@endsection
