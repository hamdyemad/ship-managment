@extends('Dashboard.app')

@section('title',__('site.shipment'))

@section('page_name',__('site.shipment'))

@section('pages')

@endsection

@section('css')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
    div.dataTables_wrapper {
        /* width: 800px; */
        margin: 0 auto;
    }
</style>
@endsection

@section('content')

<div class="card">

    <div class="card-body pt-0">
        <br>
        <!--begin::Table-->
        <table id="example" class="table is-striped" style="width:100%">
            <thead>
                <tr>
                    <th>{{__('site.id')}}</th>
                    <th>{{__('site.status')}}</th>
                    <th>{{__('site.user')}}</th>
                    <th>{{__('site.phone')}}</th>
                    <th>{{__('site.address')}}</th>
                    <th>{{__('site.traching')}}</th>
                    <th>{{__('site.onhold')}}</th>
                    <th>{{__('site.created_at')}}</th>
                    <th>{{__('site.updated_at')}}</th>
                    <th>{{__('site.price')}}</th>
                    <th>{{__('site.city')}}</th>
                    <th>{{__('site.area')}}</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-bold">
                @foreach ($show as $shipment)
                <tr>
                    <td>{{$shipment->id}}</td>
                    <td>{{$shipment->status}}</td>
                    <td>{{$shipment->receiver_name}}</td>
                    <td>{{$shipment->receiver_phone}}</td>
                    <td>{{$shipment->address}}</td>
                    <td>{{$shipment->barcode}}</td>
                    @if ($shipment->on_hold == null)
                    <td>--</td>
                    @else
                    <td>{{$shipment->on_hold}}</td>
                    @endif
                    <td>{{$shipment->created_at}}</td>
                    <td>{{$shipment->updated_at}}</td>
                    <td>{{$shipment->price}}</td>
                    <td>{{$shipment->city->city}}</td>
                    <td>{{$shipment->area->area}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <!--end::Table-->
    </div>

</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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



<script type="text/javascript">
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


</script>

@endpush
