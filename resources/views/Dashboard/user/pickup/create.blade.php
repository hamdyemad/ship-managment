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
        @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
            <a href="{{route('assignedpickup.create')}}" class="text-muted text-hover-primary">{{__('site.pickup')}}</a>
        @else
            <a href="{{route('pickup.index')}}" class="text-muted text-hover-primary">{{__('site.pickup')}}</a>
        @endif
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->

    <li class="breadcrumb-item text-muted">
        <span  class="text-muted">{{__('site.create')}}</span>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')

@endsection

@section('content')



<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details"
        aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('site.pickup')}}</h3>
        </div>

        <div class="card-title m-0">
            <a href="{{route('getCity')}}" class="btn btn-light-primary me-3" target="_blank">
                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                <span class="svg-icon svg-icon-2">
                </span>
                <!--end::Svg Icon-->Add Address
            </a>
        </div>

        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                @if(Auth::guard('admin')->check() || Auth::guard('employee')->check())
                    <div class="row mb-12">
                        <!--begin::shipment type-->
                        <div class="col-lg-12 fv-row">
                            <label
                                class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.shipment.seller')}}</label>
                            <select name="user_id" id="shipment_seller"
                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                <option value="">{{ __('site.choose_seller') }}</option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <!--end::shipment type-->
                    </div>
                @endif
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
                            @foreach ($address as $address)
                            <option id="address_line" value="{{$address->id}}">
                                {{$address->address_line}}</option>
                            @endforeach
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
                                <input type="time" id="time" name="time"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::time-->

                            <!--begin::date-->
                            <div class="col-lg-4 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.date')}}</label>
                                <input type="date" id="date" name="date"
                                    class="form-control form-control-lg form-control-solid">
                            </div>
                            <!--end::date-->

                            <!--begin::package-->
                            <div class="col-lg-3 fv-row">
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.package')}}</label>
                                <input type="number" id="package" name="package" value="{{$shipment}}"
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

                        <input type="text" id="contact_name"
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
                                <input type="text" id="email"
                                    class="form-control form-control-lg form-control-solid dynamic">
                            </div>
                            <!--end::shipment type-->

                            <!--begin::Col-->
                            <div id="phone1" class="col-lg-6 fv-row">
                                <label for="phone" class="col-lg-4 col-form-label fw-bold fs-6">phone</label>
                                <input type="text" id="phone"
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
                            style="height: 100px"></textarea>
                        <label for="note">{{__('site.note')}}</label>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::note-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="addshipment()" class="btn btn-primary"
                    id="kt_account_profile_details_submit">
                    {{__('site.add')}}
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

@endsection

@section('js')

<script>
    //show contact details based on address
        $(document).ready(function(){

            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                var select = $(this).attr("id");

                var value = $(this).val();


                var dependent = $(this).data('dependent');


                var _token = $('input[name="_token"]').val();
                    document.getElementById("email1").hidden = true;
                    document.getElementById("phone1").hidden = true;

                $.ajax({
                url:"{{ route('dynamicdependent.fetch2') }}",
                method:"POST",
                data:{select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                $('#'+ dependent).html(result);
                }

                })
                }
            });

                $('#city').change(function(){
                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');

                });

        });

    $("#shipment_seller").on('change', function() {
        $("#address").children().each((index, child) => {
            $(child).remove();
        })
        $("#address").append(`
        <option value="" disabled selected>address
                            </option>`);
        $.ajax({
            'method': 'post',
            'url': "{{ route('user.addresses') }}",
            'data': {
                '_token': $('input[name="_token"]').val(),
                'user_id': $(this).val()
            },
            'success':function(res){
                if(res.success) {
                    res.data.forEach((dat) => {
                        $("#address").append(`
                            <option id="address_line" value="${dat.id}">
                                ${dat.address_line}</option>
                        `);
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            'err':function(err){

            }
        })
    });

    //add shipment details
        function addshipment() {
            axios.post('/dashboard/pickup', {
                @if(Auth::guard('user')->check())
                    user_id:{{auth()->user()->id}},
                @else
                    user_id: document.getElementById('shipment_seller').value,
                @endif
                address: document.getElementById('address').value,
                time: document.getElementById('time').value,
                date: document.getElementById('date').value,
                name: document.getElementById('contact_name').value,
                email: document.getElementById('email').value,
                phone:document.getElementById('phone').value,
                note:document.getElementById('note').value,
                package:document.getElementById('package').value,
            })
            .then(function (response) {
                //2xx
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500
                });
                document.getElementById('kt_account_profile_details_form').reset();
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
                });

            });
        }


</script>

@endsection
