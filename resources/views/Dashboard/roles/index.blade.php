@extends('Dashboard.app')

@section('title',__('site.accountdriver'))

@section('page_name',__('site.accountdriver'))

@section('pages')

@endsection

@section('css')


{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}


{{-- <style>
    div.dataTables_wrapper {
        /* width: 800px; */
        margin: 0 auto;
    }
</style> --}}
@endsection

@section('content')

<div class="card">

    <div class="card-body pt-0">
        <br>
        <!--begin::Table-->

        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('site.name')}}</th>
                    <th>{{__('site.guard')}}</th>
                    <th>{{__('site.permissions')}}</th>
                    <th>{{__('site.created_at')}}</th>
                    <th>{{__('site.updated_at')}}</th>
                    {{-- <th style="width: 40px">Settings</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->guard_name}}</td>
                    <td>
                        <a class="btn btn-app bg-info" href="{{route('roles.show',$role->id)}}">
                            <span class="badge bg-danger">{{$role->permissions_count}}</span>
                            <i class="fas fa-heart"></i> {{__('site.permissions')}}
                        </a>
                    </td>
                    <td>{{$role->created_at}}</td>
                    <td>{{$role->updated_at}}</td>
                    {{-- <td>
                        <div class="btn-group">
                            <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('{{$role->id}}',this)" class=" btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td> --}}
                </tr>
                @endforeach

            </tbody>
        </table>

        <!--end::Table-->
    </div>

</div>

@endsection

@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bulma.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bulma.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
--}}


{{-- <script type="text/javascript">
    $(document).ready(function() {
            var table = $('#example').DataTable( {
            lengthChange: false,
            scrollX: true,
            buttons: [  'excel', 'pdf', 'print' ]
        } );

        // Insert at the top left of the table
        table.buttons().container()
        .appendTo( $('div.column.is-half', table.table().container()).eq(0) );
    } );


</script> --}}

@endpush
