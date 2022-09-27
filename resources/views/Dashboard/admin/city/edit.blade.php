@extends('Dashboard.app')

@section('title',__('site.city'))

@section('page_title',__('site.all_city'))

@section('page_name',__('site.home'))

@section('pages',__('site.city'))


@section('css')

@endsection

@section('content')


<!--begin::Card-->
<div class="card">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Form-->
        <form id="kt_invoice_form">
            @csrf

            <!--begin::Wrapper-->
            <div class="mb-0">
                <!--begin::Row-->
                <div class="row gx-10 mb-5">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('site.city')}}</label>
                        <!--begin::Input city-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" id="city" name="city"
                                value="{{$city->city}}">
                        </div>
                        <!--end::Input city-->
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('site.rate')}}</label>
                        <!--begin::Input rate-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" id="rate" name="rate"
                                value="{{$city->rate}}">
                        </div>
                        <!--end::Input rate-->

                        <div class="modal-footer">
                            <a class="btn btn-info" href="/dashboard/city">{{ __('site.back') }}</a>
                            <button type="button" id="button_value" value="{{$city->rate}}" onclick="updatecity()"
                                class="btn btn-primary">{{__('site.update')}}</button>
                        </div>

                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->


            </div>
            <!--end::Wrapper-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->


@endsection

@section('js')

<script>
    // update city .
    function updatecity(){
        axios.put('/dashboard/city/{{$city->id}}', {
        city: document.getElementById('city').value,
        rate: document.getElementById('rate').value,
        id:'{{$city->id}}',
        old_value: document.getElementById('button_value').value,

        })
        .then(function (response) {
            console.log(response);
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500
            });
            window.location.href = '/dashboard/city';
        })
        .catch(function (error) {
            console.log(error);
            Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: "error",
            showConfirmButton: false,
            timer: 1500
            })
        });
    }

</script>

@endsection
