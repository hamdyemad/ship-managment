<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="This ">

    <meta name="author" content="Code With Mark">
    <meta name="authorUrl" content="http://codewithmark.com">

    <!--[CSS/JS Files - Start]-->
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
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            box-sizing: border-box;
            font-size: 14px;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6;
        }

        /* Let's make sure all tables have defaults */
        table td {
            vertical-align: top;
        }

        /* table {
            width: 100%;
        } */

        /* -------------------------------------
        BODY & CONTAINER
        ------------------------------------- */
        body {
            background-color: #f6f6f6;
        }

        .body-wrap {
            background-color: #f6f6f6;
            width: 100%;
        }

        .container {
            display: block !important;
            max-width: 600px !important;
            margin: 0 auto !important;
            /* makes it centered */
            clear: both !important;
        }


        p {
            width: 20%;
            margin: 0 auto !important;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            display: block;
            padding: 20px;
        }

        /* -------------------------------------
        HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #fff;
            border: 3px solid #e9e9e9;
            border-radius: 3px;
        }

        #container_content2 {
            border: 3px solid #e9e9e9;
            /* width: 100%; */
        }

        .content-wrap {
            padding: 20px;
        }

        .content-block {
            padding: 0 0 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 25px;
            border: 1px solid;
        }



        .aligncenter {
            text-align: center;
        }


        .clear {
            clear: both;
        }

        /* table {
            transform: rotate(-0.25turn);
        } */


        @media only screen and (max-width: 640px) {


            .container {
                width: 100% !important;
            }

            .content,
            .content-wrap {
                padding: 10px !important;
            }

        }
    </style>
</head>

<body>
    <div class="text-center" style="padding:20px;">
        <input type="button" id="rep" value="Print" class="btn btn-info btn_print">
    </div>
    <center>
        <table id="container_content2" class="main" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="2" style="text-align: center;"><img width="130px" src="{{asset('shippment-logo.png')}}"
                            alt="">
                    </th>


                    <th colspan="3" style="text-align: center;">Allow to open</th>

                </tr>
                <tr>
                    <th style="background-color: #D6EEEE;font-size: 19px;">city</th>
                    <td style="width: 20%;text-align: center;font-size: 19px;">{{$show->city->city}}
                    </td>
                    <th colspan="3" style="background-color: #D6EEEE;font-size: 19px;text-align: center;">address</th>



                </tr>
                <tr>
                    <th style="background-color: #D6EEEE;font-size: 19px;">area</th>
                    <td style="text-align: center;font-size: 19px;">{{$show->area->area}}</td>
                    <td colspan="3" style="text-align: center;font-size: 19px;">{{$show->address}}
                    </td>

                </tr>
                <tr>
                    <th style="background-color: #D6EEEE;font-size: 19px;">name</th>
                    <td colspan="2" style="text-align: center;font-size: 19px;">{{$show->receiver_name}}
                    </td>
                    <th style="background-color: #D6EEEE;text-align: center;font-size: 19px;">phone</th>
                    <td style="text-align: center;font-size: 19px;">{{$show->receiver_phone}}</td>
                </tr>
                <tr>
                    <th style="background-color: #D6EEEE;font-size: 19px;">shipper</th>
                    <td style="text-align: center;font-size: 19px;">{{auth()->user()->name}}</td>
                    <th style="background-color: #D6EEEE;font-size: 19px;">price</th>
                    <td style="text-align: center;font-size: 19px;">{{$show->price}}</td>
                    <th style="background-color: #D6EEEE;font-size: 19px;">{{$show->shippment_type}}</th>

                </tr>
                <tr>

                    <td colspan="3">{{$show->note}}</td>
                    <td colspan="2">
                        <br>
                        <div style="margin-left:55px!important;">

                            <?php
                                                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                                echo $generator->getBarcode($show->barcode, $generator::TYPE_CODE_128);

                                                                 ?>

                            <p style="margin-left:48px!important;">{{$show->barcode}}</p>

                        </div>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>

    </center>


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
    			  margin:       1,
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
