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
    <li class="breadcrumb-item text-muted"></li>
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
                            <input type="text" class="form-control form-control-solid" id="area" name="area" value="">
                        </div>
                        <!--end::Input city-->
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('site.rate')}}</label>
                        <!--begin::Input rate-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" id="rate" name="rate" value="">
                        </div>
                        <!--end::Input rate-->

                        <div class="modal-footer">
                            <button type="button" id="button_arae" value="{{$city}}" onclick="addarea()"
                                class="btn btn-primary">{{__('site.add')}}</button>
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
    // add area one time
    function addarea(){
    axios.post('/dashboard/area', {
    area: document.getElementById('area').value,
    rate: document.getElementById('rate').value,
    city_id: document.getElementById('button_arae').value,
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
    document.getElementById('create-form').reset();
    $('#exampleModal').modal('hide');
    location.reload();

    })
    .catch(function (error) {
    console.log(error);
    Swal.fire({
    position: 'top-end',
    icon: 'error',
    title: response.data.message,
    showConfirmButton: false,
    timer: 1500
    })
    });
    }

</script>

@endsection
