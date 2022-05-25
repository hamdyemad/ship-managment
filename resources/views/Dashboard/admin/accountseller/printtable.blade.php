<!DOCTYPE html>
<html>

<head>
    <title>Laravel 6 Search Report</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    {{--
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    {{-- <center>
        <p>السلام</p>
    </center> --}}
    <table class="table">
        <thead style="background-color: rgb(191, 189, 189)">
            <tr>
                <th>id</th>
                <th>date</th>
                <th>status</th>
                <th>contact name</th>
                <th>contact phone</th>
                <th>city</th>
                <th>area</th>
                <th>cash</th>
                <th>area rate</th>
                <th>cost</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($show as $PDFReports)
            <tr>
                <td>{{ $PDFReports->id }}</td>
                <td>{{ $PDFReports->created_at }}</td>
                <td>{{ $PDFReports->shippment->status }}</td>
                <td>{{ $PDFReports->shippment->receiver_name }}</td>
                <td>{{ $PDFReports->shippment->receiver_phone }}</td>
                <td>{{ $PDFReports->shippment->city->city }}</td>
                <td>{{ $PDFReports->shippment->area->area }}</td>
                <td>{{ $PDFReports->cash }}</td>
                @if($PDFReports->shippment->user->special_price != 0 && $PDFReports->shippment->city->id ==
                $PDFReports->shippment->user->city_id &&
                $PDFReports->shippment->area->id == $PDFReports->shippment->user->area_id)

                <td>{{$PDFReports->shippment->user->special_price}}</td>
                @else
                <td>{{$PDFReports->shippment->area->rate}}</td>
                @endif
                <td>{{ $PDFReports->cost }}</td>

            </tr>
            @endforeach
        </tbody>
        <tfoot style="background-color: rgb(191, 189, 189)">
            <tr>
                <td colspan="9">
                    <center>Total</center>
                </td>
                <td>{{$total}}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
