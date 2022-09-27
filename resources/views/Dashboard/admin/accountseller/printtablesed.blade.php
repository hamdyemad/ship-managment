<!DOCTYPE html>
<html>

<head>
    <title>Scheduless Seller</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>

        td,th {
            background-color: rgb(239, 239, 239);
            padding: 10px;
            margin:10px;
        }
    </style>
</head>

<body>
    <div style="text-align: center;" id="printpdf">
        <table class="table">
            <thead style="background-color: rgb(191, 189, 189)">
                <tr>
                    <td colspan="3">Seller Name</td>
                    <td colspan="8">{{ $seller->name }}</td>
                </tr>
                <tr>
                    <th>ship & pickup id</th>
                    <th>type</th>
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
                @if($PDFReports->shippment_id !== null)
                    <tr>
                        <td>{{ $PDFReports->shippment->id }}</td>
                        <td>shippment</td>
                        <td>{{ $PDFReports->created_at }}</td>
                        <td>{{ $PDFReports->shippment->status }}</td>
                        <td>{{ $PDFReports->shippment->receiver_name }}</td>
                        <td>{{ $PDFReports->shippment->receiver_phone }}</td>
                        <td>{{ $PDFReports->shippment->city->city }}</td>
                        <td>{{ $PDFReports->shippment->area->area }}</td>
                        <td>{{ $PDFReports->cash }}</td>
                        <td>{{-$PDFReports->rate}}</td>
                        <td>{{ $PDFReports->cost }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $PDFReports->pickup->id }}</td>
                        <td>pickup</td>
                        <td>{{ $PDFReports->created_at }}</td>
                        <td>{{ $PDFReports->pickup->status }}</td>
                        <td>{{ $PDFReports->pickup->name }}</td>
                        <td>{{ $PDFReports->pickup->phone }}</td>
                        <td>{{ $PDFReports->pickup->address->city->city }}</td>
                        <td>{{ $PDFReports->pickup->address->area->area }}</td>
                        <td>--</td>
                        <td>--</td>
                        <td>-{{ $PDFReports->seller_commission }}</td>
                    </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot style="background-color: rgb(191, 189, 189)">
                <tr>
                    <td colspan="10">
                        <center>Price</center>
                    </td>
                    <td>{{ $schedule->price }}</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <center>Additional Price</center>
                    </td>
                    <td>{{ $schedule->additional_price }}</td>
                </tr>
                <tr>
                    <td colspan="10">
                        <center>Costs</center>
                    </td>
                    <td>{{ $schedule->costs }}</td>
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
