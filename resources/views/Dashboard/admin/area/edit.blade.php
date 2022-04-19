@extends('Dashboard.app')

@section('title',__('site.area'))



@section('page_name',__('site.area'))


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
        <a href="{{route('area.index')}}" class="text-muted text-hover-primary">{{__('site.area')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{$area->area}}</li>
    <!--end::Item-->
</ul>

@endsection

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
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('site.area')}}</label>
                        <!--begin::Input city-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" id="area" name="area"
                                value="{{$area->area}}">
                        </div>
                        <!--end::Input city-->
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('site.rate')}}</label>
                        <!--begin::Input rate-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" id="rate" name="rate"
                                value="{{$area->rate}}">
                        </div>
                        <!--end::Input rate-->

                        <div class="modal-footer">
                            <button type="button" onclick="updatearea()"
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
    // update area .
    function updatearea(){
        axios.put('/dashboard/area/{{$area->id}}', {
        area: document.getElementById('area').value,
        rate: document.getElementById('rate').value,
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
            // window.location.href = '/dashboard/area/';
            window.history.back();
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
