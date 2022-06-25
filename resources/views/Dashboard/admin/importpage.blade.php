@extends('Dashboard.app')

@section('title',__('site.shipment'))

@section('page_name',__('site.shipment'))

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
        <a href="" class="text-muted text-hover-primary">{{__('site.shipment')}}</a>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')
<style>
    h4 {
        /* animation: cssAnimation 0s 5s forwards;
        opacity: 0; */
        color: rgba(238, 51, 51, 0.663);
        animation: hideMe 5s forwards;
    }

    @keyframes hideMe {
        0% {
            color: rgba(238, 51, 51, 0.474);
            opacity: 1;
        }

        99.99% {
            color: rgba(238, 51, 51, 0.262);
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
@endsection

@section('content')

@if($errors->any())
<h4>&nbsp; {{$errors->first()}}</h4>
<script>
    Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Create failed!',
                showConfirmButton: false,
                timer: 1500
            })
</script>
@endif
<!--begin::Card-->
<div class="card">
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <form action="{{route('import.Shippment')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-6">
                <div class="col-lg-12">
                    <label for="formFileDisabled"
                        class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.addfileshippment')}}</label>
                    <input class="form-control form-control-lg form-control-solid" type="file" name="file"
                        id="formFileDisabled" />

                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                    {{__('site.add')}}
                </button>
            </div>
        </form>
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->

@endsection

@push('scripts')

@endpush
