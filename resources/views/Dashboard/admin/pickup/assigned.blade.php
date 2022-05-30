@extends('Dashboard.app')

@section('page-name')


@section('pages')


@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
    #scroll {
        margin: 4px, 4px;
        padding: 4px;
        /* background-color: green; */
        width: 500px;
        height: 110px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: justify;
    }
</style>
@endsection

@section('content')

<!--begin::Layout-->
<div class="d-flex flex-column flex-xl-row">

    <!--begin::user info-->
    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">

            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"
                        role="button" aria-expanded="false" aria-controls="kt_user_view_details">{{__('site.driver')}}
                        <span class="ms-2 rotate-180">
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
                <!--end::Details toggle-->
                <div class="separator"></div>
                <!--begin::Details content-->
                <div id="kt_user_view_details" class="collapse show">
                    <div class="pb-5 fs-6">

                        <form id="kt_account_profile_details_form" class="form">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">


                                <!--begin::Input password_confirmation-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    {{-- <label class="">{{__('site.password_confirmation')}}</label> --}}
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-13 fv-row">
                                        <select class="form-select" aria-label="Default select example" id="driver_id">
                                            <option selected>Open this select menu</option>
                                            @foreach ($driver as $drivers)
                                            <option value="{{$drivers->id}}">{{$drivers->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input password_confirmation-->


                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            {{-- <div class="card-footer d-flex justify-content-end py-2 px-6">
                                <button type="button" onclick="performUpdate()" class="btn btn-primary"
                                    id="kt_account_profile_details_submit">{{__('site.save_changes')}}</button>
                            </div> --}}
                            <!--end::Actions-->
                        </form>


                    </div>
                </div>
                <!--end::Details content-->
            </div>
            <!--end::Card body-->

        </div>
        <!--end::Card-->


    </div>
    <!--end::user info-->

    <!--begin::pick up location-->
    <div class="flex-lg-row-fluid ms-lg-15">

        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">

                    <!--begin::Card body-->
                    <div class="card-body">

                        <div class="d-flex flex-stack fs-4 py-3">
                            <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="" role="button"
                                aria-expanded="" aria-controls="kt_user_view_details">{{__('site.pickup')}}
                                <span class="ms-2 rotate-180">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-3">

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>

                        </div>
                        <div class="separator"></div>
                        <!--begin::Details content-->
                        <div id="kt_user_view_details" class="collapse show">
                            <div class="pb-5 fs-6">

                                <form id="kt_account_profile_details_form" class="form">
                                    {{-- @csrf --}}
                                    <!--begin::Card body-->
                                    <div class="card-body border-top p-9">



                                        <!--begin::Input building-->
                                        <div class="row mb-12">
                                            <!--begin::Label-->
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <!--begin::Row-->
                                                <div class="row">

                                                    <!--begin::address line-->
                                                    <div class="col-lg-12 fv-row fv-plugins-icon-container" id="scroll">
                                                        {{-- <select id="pickup_id" class="selectpicker" multiple
                                                            data-live-search="true">
                                                            @foreach ($pickup as $pickups)
                                                            <option value="{{$pickups->id}}">
                                                                {{$pickups->address->city->city}} //
                                                                {{$pickups->address->area->area}}
                                                                //{{$pickups->address->address_line}}
                                                            </option>
                                                            @endforeach
                                                        </select> --}}
                                                        @foreach ($pickup as $pickups)
                                                        <label><input type="checkbox" value="{{$pickups->id}}"
                                                                name="address">{{$pickups->address->city->city}}
                                                            //
                                                            {{$pickups->address->area->area}}
                                                            //{{$pickups->address->address_line}}</label>
                                                        @endforeach
                                                    </div>
                                                    <!--end::address line-->



                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input building-->

                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-2 px-6">
                                        <button type="button" onclick="assignepickup()" class="btn btn-primary"
                                            id="">{{__('site.save_changes')}}</button>
                                    </div>
                                    <!--end::Actions-->
                                </form>


                            </div>
                        </div>
                        <!--end::Details content-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::pick up location-->


</div>
<!--end::Layout-->


@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function assignepickup() {
        var favorite = [];
        $.each($("input[name='address']:checked"), function(){
        favorite.push($(this).val());
        });

        axios.post('/dashboard/assignedpickup', {

            driver_id: document.getElementById('driver_id').value,
            arr:favorite,
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
// $(document).ready(function() {
//     $("button").click(function(){
//     var favorite = [];
//     $.each($("input[name='address']:checked"), function(){
//     favorite.push($(this).val());
//     });
//     alert("My favourite sports are: " + favorite.join(", "));
//     });
//     });

</script>

@endsection
