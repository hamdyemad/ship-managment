<!DOCTYPE html>
<html>

<head>
    <title> print pdf for all shippments</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <h4> Driver Name : {{$drivers->name}}</h4>
    <h5>Driver Id : {{$drivers->id}}</h5>
    <table class="table">
        <thead style="background-color: rgb(191, 189, 189)">
            <tr>
                <th>id</th>
                <th>status</th>
                <th>contact name</th>
                <th>contact phone</th>
                <th>city</th>
                <th>area</th>
                {{-- <th>cash</th>
                <th>area rate</th>
                <th>cost</th>
                <th>delivery commission</th> --}}

            </tr>
        </thead>
        <tbody>
            @foreach ($delivery as $PDFReports)
            <tr>
                <td>{{ $PDFReports->shippment->id }}</td>
                {{-- <td>{{ $PDFReports->created_at }}</td> --}}
                <td>{{ $PDFReports->shippment->status }}</td>
                <td>{{ $PDFReports->shippment->receiver_name }}</td>
                <td>{{ $PDFReports->shippment->receiver_phone }}</td>
                <td>{{ $PDFReports->shippment->city->city }}</td>
                <td>{{ $PDFReports->shippment->area->area }}</td>
                {{-- <td>{{ $PDFReports->accountseller->cash }}</td>
                @if($PDFReports->user->special_price != 0 && $PDFReports->city->id ==
                $PDFReports->user->city_id &&
                $PDFReports->area->id == $PDFReports->user->area_id)

                <td>{{$PDFReports->user->special_price}}</td>
                @else
                <td>{{$PDFReports->area->rate}}</td>
                @endif
                <td>{{ $PDFReports->accountseller->cost }}</td>
                <td>{{ $PDFReports->accountseller->delivery_commission }}</td> --}}

            </tr>
            @endforeach
        </tbody>
        {{-- <tfoot style="background-color: rgb(191, 189, 189)">
            <tr>
                <td colspan="10">
                    <center>Total</center>
                </td>
                <td>{{$total}}</td>
                <td>{{$totaldrivercommission}}</td>
            </tr>
        </tfoot> --}}
    </table>
</body>

</html>
