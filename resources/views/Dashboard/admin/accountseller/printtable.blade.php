@extends('Dashboard.app')

@section('title',__('site.accountseller'))

@section('page_name',__('site.accountseller'))

@section('pages')

@endsection

@section('css')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
    div.dataTables_wrapper {
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
                    <th width="100">type</th>
                    <th>date</th>
                    <th>status</th>
                    <th>Co.name</th>
                    <th>Co.phone</th>
                    <th>city</th>
                    <th>area</th>
                    <th>cash</th>
                    <th>rate</th>
                    <th>cost</th>
                    <th>pickup_price</th>
                    <th>pure</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-bold">
                @foreach ($show as $PDFReports)
                    @if($PDFReports->shippment)
                        <tr>
                            <td>{{ $PDFReports->shippment_id }}</td>
                            <td>shippment-{{ $PDFReports->shippment->shippment_type }}</td>
                            <td>{{ $PDFReports->created_at }}</td>
                            <td>{{ $PDFReports->shippment->status }}</td>
                            <td>{{ $PDFReports->shippment->receiver_name }}</td>
                            <td>{{ $PDFReports->shippment->receiver_phone }}</td>
                            <td>{{ $PDFReports->shippment->city->city }}</td>
                            <td>{{ $PDFReports->shippment->area->area }}</td>
                            <td>{{ $PDFReports->cash }}</td>
                            <td>{{-$PDFReports->rate}}</td>
                            <td>{{ $PDFReports->cost }}</td>
                            <td>--</td>
                            <td>{{ $PDFReports->cost }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $PDFReports->pickup_id }}</td>
                            <td>pickup</td>
                            <td>{{ $PDFReports->created_at }}</td>
                            <td>{{ $PDFReports->pickup->status }}</td>
                            <td>{{ $PDFReports->pickup->name }}</td>
                            <td>{{ $PDFReports->pickup->phone }}</td>
                            <td>{{ $PDFReports->pickup->address->city->city }}</td>
                            <td>{{ $PDFReports->pickup->address->area->area }}</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>-{{ $PDFReports->seller_commission }}</td>
                            <td>-{{ $PDFReports->seller_commission }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>

                    <td colspan="4">
                        <form class="d-flex" action="{{ route('settlement_sellers') }}" method="POST">
                            @csrf
                            <input  type="text" name="description" placeholder="Description">
                            <input type="hidden" name="type" value="{{ request('type') }}">
                            <input type="hidden" name="shippment" value="{{ json_encode(request('shippment')) }}">
                            <input type="hidden" name="pickup" value="{{ json_encode(request('pickup')) }}">
                            <input type="hidden" name="seller_id" value="{{ request('seller_id') }}">
                            <input type="hidden" name="from" value="{{ request('from') }}">
                            <input type="hidden" name="to" value="{{ request('to') }}">
                            <input class="form-control additional" value="0" name="additional" type="number">
                            <button class="btn btn-success">save</button>
                        </form>
                    </td>
                    <td colspan="7">
                        <center>Total</center>
                    </td>
                    <td>
                        <div class="total">{{$total}}</div>
                    </td>
                </tr>
            </tfoot>

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


    let total = parseInt($('.total').text());
    $(".additional").on('change keyup', function() {
        $('.total').text(total + parseInt($(this).val()))
    });


</script>

@endpush
0000
