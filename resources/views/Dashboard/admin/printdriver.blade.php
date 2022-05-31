<!DOCTYPE html>
<html>

<head>
    <title>Laravel 6 Search Report</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        /* .page {
            display: flex;
            align-items: center;
        }

        .page-break {
            page-break-after: always;
        } */
        /* body {
            font-family: 'DejaVu Sans', sans-serif;
        } */
    </style>
</head>

<body>
    {{-- <center>
        <p>السلام</p>
    </center> --}}
    <table class="table">
        <thead style="background-color: rgb(191, 189, 189)">
            <tr>
                <th>id</th>
                {{-- <th>date</th> --}}
                <th>status</th>
                <th>shipper name</th>
                <th>shipper phone</th>
                <th>contact name</th>
                <th>contact phone</th>
                <th>city</th>
                <th>area</th>
                <th>cash</th>
                <th>area rate</th>
                <th>cost</th>
                <th>delivery commission</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($show as $PDFReports)
            @if ($PDFReports->shippment_id==null)
            <tr>
                <td>{{ $PDFReports->id }}</td>
                <td>{{ $PDFReports->status }}</td>
                <td>{{ $PDFReports->pickup->name }}</td>
                <td>{{ $PDFReports->pickup->phone}}</td>
                <td>--</td>
                <td>--</td>
                <td>{{ $PDFReports->pickup->address->city->city }}</td>
                <td>{{ $PDFReports->pickup->address->area->area }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{{ $PDFReports->delivery_commission }}</td>

            </tr>
            @elseif($PDFReports->pickup_id==null)
            <tr>
                <td>{{ $PDFReports->id }}</td>
                {{-- <td>{{ $PDFReports->created_at }}</td> --}}
                <td>{{ $PDFReports->status }}</td>
                <td>{{ $PDFReports->user->name }}</td>
                <td>{{ $PDFReports->user->phone}}</td>
                <td>{{ $PDFReports->receiver_name }}</td>
                <td>{{ $PDFReports->receiver_phone }}</td>
                <td>{{ $PDFReports->city->city }}</td>
                <td>{{ $PDFReports->area->area }}</td>
                <td>{{ $PDFReports->accountseller->cash }}</td>
                @if($PDFReports->status == 'picked up')
                <td>0</td>
                @else

                @if($PDFReports->user->special_price != 0 && $PDFReports->city->id ==
                $PDFReports->user->city_id &&
                $PDFReports->area->id == $PDFReports->user->area_id)

                <td>{{$PDFReports->user->special_price}}</td>
                @else
                <td>{{$PDFReports->area->rate}}</td>
                @endif

                @endif
                <td>{{ $PDFReports->accountseller->cost }}</td>
                <td>{{ $PDFReports->accountseller->delivery_commission }}</td>

            </tr>
            @endif

            @endforeach
        </tbody>
        <tfoot style="background-color: rgb(191, 189, 189)">
            <tr>
                <td colspan="10">
                    <center>Total</center>
                </td>
                <td>{{$total}}</td>
                <td>{{$totaldrivercommission}}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
