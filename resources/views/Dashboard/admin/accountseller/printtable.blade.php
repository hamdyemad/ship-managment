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
    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script>
    <style>
        table {
            width: 67% !important;
        }

        th,
        td {
            border-bottom: 1px solid #ddd !important;
        }

        h4 {
            font-style: oblique;
            margin-left: 350px !important;
            /* text-align: center; */
        }
    </style>
</head>

<body>
    <div class="text-center" style="padding:20px;">
        <input type="button" id="rep" value="Print" class="btn btn-info btn_print">
    </div><br>
    {{-- <center> --}}
        <div id="container_content2">
            <h4>تسوية العملاء</h4>
            <table class="table" style="text-align: center;">
                <thead style="background-color: rgb(191, 189, 189)">
                    <tr>
                        <th>id</th>
                        <th>date</th>
                        <th>status</th>
                        <th>Co.name</th>
                        <th>Co.phone</th>
                        <th>city</th>
                        <th>area</th>
                        <th>cash</th>
                        <th>area rate</th>
                        <th>cost</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($show as $PDFReports)
                    @if ($PDFReports->pickup_id == null)
                    <tr>
                        <td>{{ $PDFReports->id }}</td>
                        <td>{{ $PDFReports->created_at }}</td>
                        <td>{{ $PDFReports->shippment->status }}</td>
                        <td>{{ $PDFReports->shippment->receiver_name }}</td>
                        <td>{{ $PDFReports->shippment->receiver_phone }}</td>
                        <td>{{ $PDFReports->shippment->city->city }}</td>
                        <td>{{ $PDFReports->shippment->area->area }}</td>
                        <td>{{ $PDFReports->cash }}</td>

                        @if ($PDFReports->shippment->user->specialprices->isEmpty())
                        <td>{{$PDFReports->shippment->area->rate}}</td>
                        @else

                        @foreach ($PDFReports->shippment->user->specialprices as $item)

                        @if($PDFReports->shippment->city_id == $item->city_id &&
                        $PDFReports->shippment->area->id == $item->area_id)

                        <td>{{$item->special_price}}</td>
                        @else
                        <td>{{$PDFReports->shippment->area->rate}}</td>
                        @endif

                        @endforeach

                        @endif
                        {{-- @if($PDFReports->shippment->user->special_price != 0 && $PDFReports->shippment->city->id ==
                        $PDFReports->shippment->user->city_id &&
                        $PDFReports->shippment->area->id == $PDFReports->shippment->user->area_id)

                        <td>{{$PDFReports->shippment->user->special_price}}</td>
                        @else --}}
                        {{-- <td>{{$PDFReports->shippment->area->rate}}</td> --}}
                        {{-- @endif --}}
                        <td>{{ $PDFReports->cost }}</td>

                    </tr>
                    @elseif($PDFReports->shippment_id == null)
                    <tr>
                        <td>{{ $PDFReports->id }}</td>
                        <td>{{ $PDFReports->created_at }}</td>
                        <td>{{ $PDFReports->pickup->status }}</td>
                        <td>--</td>
                        <td>--</td>
                        <td>{{ $PDFReports->pickup->address->city->city }}</td>
                        <td>{{ $PDFReports->pickup->address->area->area }}</td>
                        <td>--</td>
                        {{-- @if($PDFReports->shippment->user->special_price != 0 && $PDFReports->shippment->city->id ==
                        $PDFReports->shippment->user->city_id &&
                        $PDFReports->shippment->area->id == $PDFReports->shippment->user->area_id)

                        <td>{{$PDFReports->shippment->user->special_price}}</td>
                        @else --}}
                        <td>--</td>
                        {{-- @endif --}}
                        <td>--</td>

                    </tr>
                    @endif

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
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function($)
        	{

        		$(document).on('click', '.btn_print', function(event)
        		{
        			event.preventDefault();
                    // $('#container_content2').css( {'transform': 'rotate(-0.25turn)'});
        			var element = document.getElementById('container_content2');

        			var opt =
        			{
        			 margin: [1, 0.1, 0, -4],

                    //   padding:50px,
                    //   size: auto,
                    // margin:,
        			  filename:     'shippment_'+js.AutoCode()+'.pdf',
        			  image:        { type: 'jpeg', quality: 0.98 },
        			  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true},
        			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        			};

        			// New Promise-based usage:
        			html2pdf().set(opt).from(element).save();


        		});



        	});
        </script>
</body>

</html>
