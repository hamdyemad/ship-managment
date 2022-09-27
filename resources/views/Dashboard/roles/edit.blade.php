@extends('Dashboard.app')

@section('title',__('site.roles'))



@section('page_name',__('site.create_role'))


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
        <a href="" class="text-muted text-hover-primary">{{__('site.area')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    {{-- <li class="breadcrumb-item text-muted">{{$area->area}}</li> --}}
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
        <form id="kt_invoice_form" method="POST" action="{{ route('roles.update', $role) }}">
            @method('PATCH')
            @csrf

            <!--begin::Wrapper-->
            <div class="mb-0">
                <!--begin::Row-->
                <div class="row gx-10 mb-5">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('site.role_name')}}</label>
                        <!--begin::Input city-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" id="name" name="name" value="{{ $role->name }}">
                            @error('name')
                                <h5 class="text-danger">{{ $message }}</h5>
                            @enderror
                        </div>
                        <!--end::Input city-->
                        <hr>
                        @error('permissions')
                            <h5 class="text-danger">{{ $message }}</h5>
                        @enderror
                        @foreach ($permissions as $key => $value)
                            <h2>{{ $key }}</h2>
                            @foreach ($value as $permission)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                    @if ($role->permissions->contains('id', $permission->id))
                                            checked
                                    @endif
                                     value="{{ $permission->id }}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        @endforeach

                        <div class="modal-footer">
                            <button class="btn btn-primary">{{__('site.edit')}}</button>
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


</script>

@endsection
