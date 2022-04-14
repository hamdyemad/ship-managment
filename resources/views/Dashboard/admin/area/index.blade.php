@extends('Dashboard.app')

@section('page-name','Area')


@section('pages','Area')

@section('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.semanticui.min.css" rel="stylesheet" type="text/css" />

@endsection

@section('button')

@foreach ($area as $areas)
<button type="button" city_id="{{$area->city}}" class="btn btn-primary" data-bs-toggle="modal"
    data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add Area</button>
@endforeach

@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add New area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-form">
                    @csrf
                    <div class="mb-3">
                        <label for="city" class="col-form-label">area</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="col-form-label">rate</label>
                        <input type="number" class="form-control" id="rate" name="rate">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="addcity()" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<table id="example" class="ui celled table" style="width:100%">
    <thead>
        <tr>
            <th>{{__('site.id')}}</th>
            <th>{{__('site.city')}}</th>
            <th>{{__('site.rate')}}</th>
            <th>{{__('site.sitting')}}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($area as $area)
        <tr>
            <td>{{$area->id}}</td>
            <td>{{$area->area}}</td>
            <td>{{$area->rate}}</td>
            <td class="text-end">
                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">Actions
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                fill="black" />
                        </svg>
                    </span>

                </a>

                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                    data-kt-menu="true">

                    <div class="menu-item px-3">
                        <a href="{{route('area.index')}}" area_id="{{$area->id}}" id="editf"
                            class="menu-link px-3">area</a>
                        {{-- <button type="button" value="{{$city->id}}" class="menu-link px-3"
                            id="#editf">update</button> --}}
                    </div>

                    <div class="menu-item px-3">
                        <a href="" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                    </div>

                </div>

            </td>

        </tr>
        @endforeach
    </tbody>

</table>


@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // add area
    function addcity(){
        axios.post('/dashboard/area', {
        city: document.getElementById('city').value,
        rate: document.getElementById('rate').value,
        city_id = var city_id = $(this).attr('city_id');
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
        })
        .catch(function (error) {
            console.log(error);
            Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: error.response.data.message,
            showConfirmButton: false,
            timer: 1500
            })
        });
    }

</script>
@endsection
