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
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

    {{-- <div class="text-center" style="padding:20px;"> --}}
        {{-- <input type="button" id="rep" value="Print" class="btn btn-info btn_print"> --}}
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                print
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                {{-- <a class="dropdown-item" href="{{route('export_shippment',request()->query())}}">excel</a> --}}
                <a class="dropdown-item btn_print" id="rep" href="#">pdf</a>
                <form>
                    <input type="date" name="from" value="{{$from}}" style="display: none">
                    <input type="date" name="to" value="{{$to}}" style="display: none">
                    <button type="button" onclick="exportData()" class="dropdown-item">excel</button>
                </form>
                {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
            </div>
        </div>
        {{-- <button onclick="exportData()">
            <span class="glyphicon glyphicon-download"></span>
            Download list</button> --}}

        {{--
    </div> --}}
    <div id="printpdf">
        <h3>
            تسوية السائقين
        </h3><br>

        <table class="table" id="tblStocks">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>status</th>
                    <th>name</th>
                    <th>phone</th>
                    <th>address</th>
                    <th>Tracking number</th>
                    <th>Price</th>
                    <th>city</th>
                    <th>area</th>
                    <th>ON Hold</th>
                    <th style="color: rgb(242, 56, 56)">Created at</th>
                    <th style="color: rgb(242, 56, 56)">updated at</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($show as $show)
                {{-- @if ($show->shippment_id ==null) --}}
                <tr>
                    <td>{{ $show->id }}</td>
                    <td>{{ $show->status }}</td>
                    <td>{{ $show->receiver_name }}</td>
                    <td>{{ $show->receiver_phone }}</td>
                    <td>{{ $show->address }}</td>
                    <td>{{ $show->barcode }}</td>
                    <td>{{ $show->price }}</td>
                    <td>{{ $show->city->city }}</td>
                    <td>{{ $show->area->area }}</td>
                    <td>{{ $show->on_hold }}</td>
                    <td>{{ $show->created_at }}</td>
                    <td>{{ $show->updated_at }}</td>

                </tr>
                {{-- @elseif($show->pickup_id ==null)
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
                @endif --}}

                @endforeach
            </tbody>
        </table>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
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

                function exportData(){
                        /* Get the HTML data using Element by Id */
                        var table = document.getElementById("tblStocks");

                        /* Declaring array variable */
                        var rows =[];

                        //iterate through rows of table
                        for(var i=0,row; row = table.rows[i];i++){
                            //rows would be accessed using the "row" variable assigned in the for loop
                            //Get each cell value/column from the row
                            column1 = row.cells[0].innerText;
                            column2 = row.cells[1].innerText;
                            column3 = row.cells[2].innerText;
                            column4 = row.cells[3].innerText;
                            column5 = row.cells[4].innerText;
                            column6 = row.cells[5].innerText;
                            column7 = row.cells[6].innerText;
                            column8 = row.cells[7].innerText;
                            column9 = row.cells[8].innerText;
                            column10 = row.cells[9].innerText;
                            column11 = row.cells[10].innerText;
                            column12 = row.cells[11].innerText;

                            /* add a new records in the array */
                            rows.push(
                            [
                            column1,
                            column2,
                            column3,
                            column4,
                            column5,
                            column6,
                            column7,
                            column8,
                            column9,
                            column10,
                            column11,
                            ]
                            );

                        }
                        csvContent = "data:text/csv;charset=utf-8,";
                        /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
                        rows.forEach(function(rowArray){
                            row = rowArray.join(",");
                            csvContent += row + "\r\n";
                        });

                        /* create a hidden <a> DOM node and set its download attribute */
                            var encodedUri = encodeURI(csvContent);
                            var link = document.createElement("a");
                            link.setAttribute("href", encodedUri);
                            const d = new Date();
                            link.setAttribute("download", "shippment" + d + ".csv");
                            document.body.appendChild(link);
                            /* download the data file named "Stock_Price_Report.csv" */
                            link.click();
                    }


    </script>
</body>

</html>
