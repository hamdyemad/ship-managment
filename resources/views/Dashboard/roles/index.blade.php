@extends('Dashboard.app')

@section('title',__('site.roles'))

@section('page_name',__('site.roles'))

@section('pages')

<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('app')}}" class="text-muted text-hover-primary">Home</a>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.semanticui.min.css" rel="stylesheet" type="text/css" />



@endsection

@can('roles.create')
    @section('button')
        <a href="/dashboard/roles/create" class="btn btn-primary">{{__('site.add_role')}}</a>
    @endsection
@endcan

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="ui celled table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>{{__('site.name')}}</th>
                            <th>{{__('site.permissions')}}</th>
                            <th>{{__('site.created_at')}}</th>
                            <th>{{__('site.updated_at')}}</th>
                            <th>{{__('site.settings')}}</th>

                        </tr>
                    </thead>
                    <tbody id="list_tbody">
                        @foreach ($roles as $role)
                        <tr>
                            <td st>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                @if(Auth::user()->can('roles.edit'))
                                    <a class="btn btn-app bg-info" href="{{route('roles.show',$role->id)}}">
                                        <span class="badge bg-danger">{{$role->permissions_count}}</span>
                                        <i class="fas fa-heart"></i> {{__('site.permissions')}}
                                    </a>
                                @else
                                    <div class="alert bg-info" href="{{route('roles.show',$role->id)}}">
                                        <span class="badge bg-danger">{{$role->permissions_count}}</span>
                                        <i class="fas fa-heart"></i> {{__('site.permissions')}}
                                    </div>
                                @endif
                            </td>
                            <td>{{$role->created_at}}</td>
                            <td>{{$role->updated_at}}</td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="black" />
                                        </svg>
                                    </span>

                                </a>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    @can('roles.destroy')
                                        <div class="menu-item px-3">
                                            <a href="#" onclick="confirmDelete('{{$role->id}}',this)" class="menu-link px-3"
                                                data-kt-customer-table-filter="delete_row">{{__('site.delete')}}</a>
                                        </div>
                                    @endcan

                                </div>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

@endsection

@section('js')

<script>
    $(document).ready(function() {
        $('#example').DataTable();

    });


    // show message to be sure to delete
    function confirmDelete(id,reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id,reference);
            }
        });
    }

    // delete City with his area ....
    function performDelete(id,reference) {
        var table1 = $('#example').DataTable();
        axios.delete('/dashboard/roles/'+id)
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
            reference.closest('tr').remove();
            location.reload();

        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error);
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: error.response.data.message,
            showConfirmButton: false,
            timer: 1500
            });
        });
    }



</script>

@endsection
