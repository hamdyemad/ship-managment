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
            border: 1px solid #e9e9e9;
            border-radius: 3px;
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
        }

        /* .footer {
            width: 100%;
            clear: both;
            color: #999;
            padding: 20px;
        }

        .footer a {
            color: #999;
        }

        .footer p,
        .footer a,
        .footer unsubscribe,
        .footer td {
            font-size: 12px;
        } */

        /* -------------------------------------
        TYPOGRAPHY
        ------------------------------------- */
        /* h1,
        h2,
        h3 {
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            color: #000;
            margin: 40px 0 0;
            line-height: 1.2;
            font-weight: 400;
        }

        h1 {
            font-size: 32px;
            font-weight: 500;
        }

        h2 {
            font-size: 24px;
        }

        h3 {
            font-size: 18px;
        }

        h4 {
            font-size: 14px;
            font-weight: 600;
        }

        p,
        ul,
        ol {
            margin-bottom: 10px;
            font-weight: normal;
        }

        p li,
        ul li,
        ol li {
            margin-left: 5px;
            list-style-position: inside;
        } */

        /* -------------------------------------
        LINKS & BUTTONS
        ------------------------------------- */
        /* a {
            color: #1ab394;
            text-decoration: underline;
        } */

        .btn-primary {
            text-decoration: none;
            color: #FFF;
            background-color: #1ab394;
            border: solid #1ab394;
            border-width: 5px 10px;
            line-height: 2;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
        }

        /* -------------------------------------
        OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .aligncenter {
            text-align: center;
        }

        .alignright {
            text-align: right;
        }

        .alignleft {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        /* -------------------------------------
        ALERTS
        Change the class depending on warning email, good email or bad email
        ------------------------------------- */
        .alert {
            font-size: 16px;
            color: #fff;
            font-weight: 500;
            padding: 20px;
            text-align: center;
            border-radius: 3px 3px 0 0;
        }

        .alert a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
        }

        .alert.alert-warning {
            background: #f8ac59;
        }

        .alert.alert-bad {
            background: #ed5565;
        }

        .alert.alert-good {
            background: #1ab394;
        }

        /* -------------------------------------
        INVOICE
        Styles for the billing table
        ------------------------------------- */
        .invoice {
            margin: 40px auto;
            text-align: left;
            width: 80%;
        }

        .invoice td {
            padding: 5px 0;
        }

        .invoice .invoice-items {
            width: 100%;
        }

        .invoice .invoice-items td {
            border-top: #eee 1px solid;
        }

        .invoice .invoice-items .total td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: 700;
        }


        /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 640px) {

            h1,
            h2,
            h3,
            h4 {
                font-weight: 600 !important;
                margin: 20px 0 5px !important;
            }

            h1 {
                font-size: 22px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            .container {
                width: 100% !important;
            }

            .content,
            .content-wrap {
                padding: 10px !important;
            }

            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="text-center" style="padding:20px;">
        <input type="button" id="rep" value="Print" class="btn btn-info btn_print">
    </div>
    <table class="body-wrap" id="container_content">
        <tbody>
            <tr>
                <td></td>
                <td class="container" width="600">
                    <div class="content">
                        <table class="main" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="content-wrap aligncenter">
                                        <table border="1" id="container_content2" class="main" width="100%"
                                            cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <th style="background-color: #D6EEEE;">city</th>
                                                    <td style="width: 20%;text-align: center;">{{$show->city->city}}
                                                    </td>
                                                    <th colspan="3" style="background-color: #D6EEEE;">address</th>



                                                </tr>
                                                <tr>
                                                    <th style="background-color: #D6EEEE;">area</th>
                                                    <td style="text-align: center;">{{$show->area->area}}</td>
                                                    <td colspan="3" style="text-align: center;">{{$show->address}}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th style="background-color: #D6EEEE;">name</th>
                                                    <td colspan="2" style="text-align: center;">{{$show->receiver_name}}
                                                    </td>
                                                    <th style="background-color: #D6EEEE;text-align: center;">phone</th>
                                                    <td style="text-align: center;">{{$show->receiver_phone}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="background-color: #D6EEEE;">shipper</th>
                                                    <td style="text-align: center;">{{auth()->user()->name}}</td>
                                                    <th style="background-color: #D6EEEE;">price</th>
                                                    <td style="text-align: center;">{{$show->price}}</td>
                                                    <th style="background-color: #D6EEEE;">cash</th>

                                                </tr>
                                                <tr>

                                                    <td colspan="3">{{$show->note}}</td>
                                                    <td colspan="2">
                                                        <br>
                                                        <div>

                                                            <?php
                                                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                            echo $generator->getBarcode($show->barcode, $generator::TYPE_CODE_128);

                                                             ?>
                                                            {{$show->barcode}}

                                                        </div>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div class="footer">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td class="aligncenter content-block">Questions? Email <a
                                                href="mailto:">support@company.inc</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($)
    	{

    		$(document).on('click', '.btn_print', function(event)
    		{
    			event.preventDefault();

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
