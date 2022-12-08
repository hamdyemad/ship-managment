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
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            box-sizing: border-box;
            font-size: 14px;
        }

        /* body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6;
        } */

        /* Let's make sure all tables have defaults */
        /* table td {
            vertical-align: top;
        } */

        /* table {
            width: 100%;
        } */

        /* -------------------------------------
        BODY & CONTAINER
        ------------------------------------- */
        body {
            background-color: #f6f6f6;
        }

        /* .body-wrap {
            background-color: #f6f6f6;
            width: 100%;
        } */

        .container {
            display: block !important;
            margin: 0 auto !important;
            clear: both !important;
        }


        p {
            width: 18%;
            margin: 0 auto !important;
        }

        .main {
            background: #fff;
            border: 3px solid #e9e9e9;
            border-radius: 3px;
        }

        #container_content2 {
            border: 3px solid #e9e9e9;
            /* width: 100%; */
        }


        td {
            padding: 16px;
            border: 1px solid;
            height: 50px !important;
        }

        #container_content2 {
            width: 80%;
            /* height: 10% !important; */
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <table id="container_content2" class="main" cellpadding="0" cellspacing="0">
            <tr>
                <td rowspan="2"><img src="{{asset('/shippment-logo.png')}}" alt=""></td>
                <td style="font-weight: bold;font-size: 18px;">city</td>
                <td style="font-weight: bold;font-size: 18px;">{{$show->city->city}}</td>
                <td style="font-weight: bold;font-size: 18px; width:30%">Allow to open</td>
                <td>@if ($show->allow_open =='true')
                    (yes)
                    @else
                    (NO)
                    @endif</td>

            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 18px;">Area</td>
                <td style="font-weight: bold;font-size: 18px;">{{$show->area->area}}</td>
                <td colspan="2">
                    <div style="font-weight: bold;font-size: 15px;">Business Ref</div> <br>{{$show->business_referance}}
                </td>

            </tr>
            <tr>
                <td colspan="2" style="font-weight: bold;font-size: 27px;">{{$show->shippment_type}}</td>
                <td colspan="3"><br>
                    @php
                        \Storage::disk('public')->put('barcodes/' . $show->barcode . '.png',base64_decode(DNS1D::getBarcodePNG($show->barcode, 'C128')));
                    @endphp
                    <img class="barcode" src="{{ asset('barcodes/' . $show->barcode . '.png') }}" alt="">
                    <br>
                    <br>
                    {{ $show->barcode }}
                </td>

            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 18px;">Receiver</td>
                <td style="font-weight: bold;font-size: 18px;">Cash</td>
                <td style="font-weight: bold;font-size: 18px;" colspan="3">Address</td>
            </tr>
            <tr>
                <td>{{$show->receiver_name}}</td>
                <td rowspan="2">{{$show->price}}</td>
                <td rowspan="2" colspan="3">{{$show->address}}</td>
            </tr>
            <tr>
                <td>{{$show->receiver_phone}}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight: bold;font-size: 18px;">Shipper</td>
                <td colspan="3">{{$show->shipper}}</td>

            </tr>
            <tr>
                <td colspan="5">
                    @if ($show->note)
                        {{$show->note}}
                    @else
                        No Notes
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight: bold;font-size: 18px;">Package Details</td>
                <td colspan="3">{{$show->package_details}}</td>

            </tr>
        </table>

    </center>
</body>

</html>
