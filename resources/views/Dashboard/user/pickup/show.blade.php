@extends('Dashboard.app')

@section('title',__('site.show'))

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
        <a href="{{route('assignedpickup.index')}}" class="text-muted text-hover-primary">{{__('site.pickup')}}</a>
    </li>
    <!--end::Item-->

</ul>

@endsection

@section('css')

@endsection

@section('content')

<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" aria-expanded="true"
        aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('site.pickup')}}</h3>
        </div>
        <!--end::Card title-->
        {{-- //export link --}}
        <div class="card-toolbar">
                @if(Auth::guard('admin')->check() || Auth::guard('employee')->check() || Auth::guard('driver')->check())
                    {{-- status dropdown --}}
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{__('site.status')}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <hr>
                            <li><a class="dropdown-item" onclick="addshipment('pickedup',{{$pickup->id}})"><i
                                        class="fa fa-circle" style="color: #94c1e2"></i>&nbsp;Picked up</a>
                            </li>
                            <hr>

                        </ul>
                    </div>
                @endif
            </div>
    </div>
    <!--begin::Card header-->



    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">

                <!--begin::location-->
                <div class="row mb-12">
                    <!--begin::Col-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.location')}}</label>
                    <div class="form-floating">
                        <select data-dependent="name" name="address" id="address" aria-label="Select a Timezone"
                            data-control="select2" data-placeholder="date_period"
                            class="form-select form-select-sm form-select-solid dynamic">
                            <option value="" disabled selected>address
                            </option>
                            {{-- @foreach ($address as $address) --}}
                            <option selected id="address_line" value="{{$pickup->address->address_line}}">
                                {{$pickup->address->address_line}}</option>
                            {{-- @endforeach --}}
                        </select>
                    </div>



                </div>
                <!--end::location-->

                <!--begin::time && date-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::time-->
                            <div class="col-lg-4 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.time')}}</label>
                                <input type="time" id="time" name="time" value="{{$pickup->time}}"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::time-->

                            <!--begin::date-->
                            <div class="col-lg-4 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.date')}}</label>
                                <input type="date" id="date" name="date" value="{{$pickup->date}}"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::date-->

                            <!--begin::package-->
                            <div class="col-lg-3 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.package')}}</label>
                                <input type="number" id="package" name="package" value="{{$pickup->package}}"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::package-->

                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::time && date-->

                <!--begin::name-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div id="name" class="form-floating">

                        <input type="text" id="contactname" value="{{$pickup->name}}"
                            class="form-control form-control-lg form-control-solid dynamic">
                        <label for="name" class="col-lg-4 col-form-label fw-bold fs-6">name</label>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::name-->

                <!--begin::email && phone-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::shipment type-->
                            <div id="email1" class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">email</label>
                                <input type="text" id="email" value="{{$pickup->email}}"
                                    class="form-control form-control-lg form-control-solid dynamic">
                            </div>
                            <!--end::shipment type-->

                            <!--begin::Col-->
                            <div id="phone1" class="col-lg-6 fv-row">
                                <label for="phone" class="col-lg-4 col-form-label fw-bold fs-6">phone</label>
                                <input type="text" id="phone" value="{{$pickup->phone}}"
                                    class="form-control form-control-lg form-control-solid dynamic">

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::email && phone-->

                <!--begin::note-->
                <div class="row mb-8">
                    <!--begin::Col-->
                    <div class="form-floating">
                        <textarea class="form-control form-control-lg form-control-solid" name="note" id="note"
                            style="height: 100px">{{$pickup->note}}</textarea>
                        <label for="note">{{__('site.note')}}</label>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::note-->
                <h3>{{ __("site.pickup_histories") }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('site.employee') }}</th>
                            <th>{{ __('site.status') }}</th>
                            <th>{{ __('site.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pickup->histories()->latest()->get() as $history)
                            @if($history->user)
                                <tr>
                                    <td>{{ $history->user->name }}</td>
                                    <td>{{ $history->status }}</td>
                                    <td>{{ \Carbon\Carbon::parse($history->created_at)->format('Y-m-d / h:i:s')}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            {{-- <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="addshipment()" class="btn btn-primary"
                    id="kt_account_profile_details_submit">
                    {{__('site.add')}}
                </button>
            </div> --}}
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

@endsection

@section('js')

<script>
    // //update the status shipment details
    function addshipment(statusofshipment,id) {
        axios.put('/dashboard/pickup/'+id, {
            status: statusofshipment,
            // pickup_id: id,
        })
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
            // document.getElementById('kt_account_profile_details_form').reset();

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

@endsection
