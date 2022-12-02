@extends('Dashboard.app')

@section('title',__('site.accountdriver'))

@section('page_name',__('site.accountdriver'))

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
                    <th>id</th>
                    <th>type</th>
                    <th>status</th>
                    <th>sh.name</th>
                    <th>sh.phone</th>
                    <th>C.name</th>
                    <th>C.phone</th>
                    <th>city</th>
                    <th>area</th>
                    <th>cash</th>
                    <th>area rate</th>
                    <th>cost</th>
                    <th>DE.commission</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-bold">
                @if($show)
                    @foreach ($show as $PDFReports)
                    @if ($PDFReports->shippment_id==null)
                        <tr>
                            <td>{{ $PDFReports->pickup->id }}</td>
                            <td>pickup</td>
                            <td>{{ $PDFReports->pickup->status }}</td>
                            <td>{{$PDFReports->pickup->user->name}}</td>
                            <td>{{$PDFReports->pickup->user->phone}}</td>
                            <td>{{ $PDFReports->pickup->name }}</td>
                            <td>{{ $PDFReports->pickup->phone}}</td>
                            <td>{{ $PDFReports->pickup->address->city->city }}</td>
                            <td>{{ $PDFReports->pickup->address->area->area }}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>{{ $PDFReports->delivery_commission }}</td>

                        </tr>
                    @elseif($PDFReports->pickup_id==null)
                    <tr>
                        <td>{{ $PDFReports->shippment->id }}</td>
                        <td>{{ __("site.shipment") . '-' . $PDFReports->shippment->shippment_type }}</td>
                        <td>{{ $PDFReports->shippment->status }}</td>
                        <td>{{ $PDFReports->shippment->user->name }}</td>
                        <td>{{ $PDFReports->shippment->user->phone}}</td>
                        <td>{{ $PDFReports->shippment->receiver_name }}</td>
                        <td>{{ $PDFReports->shippment->receiver_phone }}</td>
                        <td>{{ $PDFReports->shippment->city->city }}</td>
                        <td>{{ $PDFReports->shippment->area->area }}</td>
                        <td>{{ $PDFReports->cash }}</td>
                        <td>{{$PDFReports->rate}}</td>
                        <td>{{ $PDFReports->cost }}</td>
                        <td>{{ $PDFReports->delivery_commission }}</td>

                    </tr>
                    @endif

                    @endforeach
                    <tr>
                        <td colspan="9">
                            <center>
                                <h5>Total</h5>
                            </center>
                        </td>
                        <td><strong>{{ $show->pluck('cash')->sum() }}</strong></td>
                        <td><strong>{{ $show->pluck('rate')->sum() }}</strong></td>
                        <td><strong>{{ $show->pluck('cost')->sum() }}</strong></td>
                        <td><strong>{{ $totaldrivercommission }}</strong></td>
                    </tr>
                @endif
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
