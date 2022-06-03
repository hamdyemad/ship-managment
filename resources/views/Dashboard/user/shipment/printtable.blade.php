<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script>

    <style>
        h3 {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
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
        </h3><br>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>status</th>
                    <th>sh.name</th>
                    <th>name</th>
                    <th>phone</th>
                    <th>address</th>
                    <th>city</th>
                    <th>area</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($show as $show)
                @if ($show->shippment_id ==null)
                <tr>
                    <td>{{ $show->id }}</td>
                    <th>pick up</th>
                    <td>{{ $show->pickup->user->name }}</td>
                    <td>{{ $show->pickup->name }}</td>
                    <td>{{ $show->pickup->phone }}</td>
                    <td>{{ $show->pickup->address->address_line }}</td>
                    <td>{{ $show->pickup->address->city->city }}</td>
                    <td>{{ $show->pickup->address->area->area }}</td>

                </tr>
                @elseif($show->pickup_id ==null)
                <tr>
                    <td>{{ $show->id }}</td>
                    <td>{{ $show->shippment->status }}</td>
                    <td>{{ $show->shippment->user->name }}</td>
                    <td>{{ $show->shippment->receiver_name }}</td>
                    <td>{{ $show->shippment->receiver_phone }}</td>
                    <td>{{ $show->shippment->address }}</td>
                    <td>{{ $show->shippment->city->city }}</td>
                    <td>{{ $show->shippment->area->area }}</td>

                </tr>
                @endif

                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function($)
            	{

            		$(document).on('click', '.btn_print', function(event)
            		{
            			event.preventDefault();

            			var element = document.getElementById('printpdf');


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
