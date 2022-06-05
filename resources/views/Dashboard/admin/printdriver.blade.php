<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script>
    <title>Document</title>
    <style>
        /* -------------------------------------
        GLOBAL
        A very basic CSS reset
        ------------------------------------- */
        @page {
            font-family: 'DINNextLTArabic-Medium';
        }

        * {
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: 14px;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6;
        }


        table,
        td,
        th {
            border: 0px solid #ddd;
            text-align: left;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        body {
            background-color: #f6f6f6;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        h5 {
            font-size: 14px;
            font-weight: 600;
        }

        h3 {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
        }

        .header {
            background-color: #cdcdcd
        }

        .footer {
            background-color: #cdcdcd
        }
    </style>
</head>

<body>
    <div class="text-center" style="padding:20px;">
        <input type="button" id="rep" value="Print" class="btn btn-info btn_print">
    </div>
    <div id="printpdf">
        <h3>
            تسوية السائقين
        </h3>


        <h5> name : {{$driver->name}}</h5>
        {{-- <h5> id : {{$driver->id}}</h5> --}}
        <h5> mobile : {{$driver->phone}}</h5>

        <table>
            <thead class="header">
                <tr>
                    <th>id</th>
                    {{-- <th>date</th> --}}
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
                    <td>{{ $PDFReports->shippment->user->name }}</td>
                    <td>{{ $PDFReports->shippment->user->phone}}</td>
                    <td>{{ $PDFReports->receiver_name }}</td>
                    <td>{{ $PDFReports->receiver_phone }}</td>
                    <td>{{ $PDFReports->shippment->city->city }}</td>
                    <td>{{ $PDFReports->shippment->area->area }}</td>
                    <td>{{ $PDFReports->cash }}</td>
                    {{-- @if($PDFReports->status == 'picked up')
                    <td>0</td>
                    @else --}}

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

                    <td>{{ $PDFReports->cost }}</td>
                    <td>{{ $PDFReports->delivery_commission }}</td>

                </tr>
                @endif

                @endforeach
            </tbody>
            <tfoot class="footer">
                <tr>
                    <th colspan="10">
                        <center>Total</center>
                    </th>
                    <th>{{$total}}</th>
                    <th>{{$totaldrivercommission}}</th>
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

    			//credit : https://ekoopmans.github.io/html2pdf.js

    			var element = document.getElementById('printpdf');

    			//easy
    			//html2pdf().from(element).save();

    			//custom file name
    			//html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


    			//more custom settings
    			var opt =
    			{
    			  margin:      0.1,
    			  filename:     'pageContent_'+js.AutoCode()+'.pdf',
    			  image:        { type: 'jpeg', quality: 0.98 },
    			  html2canvas:  { scale: 2 },
    			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    			};

    			// New Promise-based usage:
    			html2pdf().set(opt).from(element).save();


    		});



    	});
    </script>
</body>

</html>
