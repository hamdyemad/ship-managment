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
                    <th>{{__('site.name')}}</th>
                    <th>{{__('site.guard')}}</th>
                    <th>{{__('site.assigned')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->guard_name}}</td>
                    <td>
                        <div class="icheck-success d-inline">
                            <input type="checkbox" id="permission_{{$permission->id}}" @if($permission->assigned)
                            checked @endif
                            onclick="updateRolePermission('{{$role->id}}','{{$permission->id}}')">
                            <label for="permission_{{$permission->id}}"></label>
                        </div>
                    </td>
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

<script>
    function updateRolePermission(roleId, permissionId) {
    axios.post('/dashboard/role/update-permission',{
      'role_id':roleId,
      'permission_id':permissionId
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
    })
    .catch(function (error) {
        //4xx - 5xx
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

@endpush
