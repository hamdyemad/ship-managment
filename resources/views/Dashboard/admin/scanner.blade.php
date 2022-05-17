@extends('Dashboard.app')

@section('title')



@section('page_name')


@section('pages')

@endsection

@section('css')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection

@section('content')
<h1 class="text-primary" style="text-align: center;margin-bottom: 20px;">Scan Barcode
</h1>

{{-- message if the barcode shippment does not exist --}}
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
{{-- ================================================ --}}

<div style="width: 500px" id="reader"></div>

<form id="myFunction" method="post" action="{{route('scan')}}" onsubmit="sendsometext()">
    @csrf
    <input type="number" style="display: none" placeholder="" name="sometext" id="myInput">
</form>

{{-- with this function the camera still working and scan --}}
{{-- <script>
    function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            }

            function onScanError(errorMessage) {
            // handle on error condition, with error message
            }

            html5QrcodeScanner.render(onScanSuccess, onScanError);
</script> --}}

{{-- <script>
    jQuery(function($){
            const html5QrCode = new Html5Qrcode('reader');
            const qrCodeSuccessCallback = message => {
            console.log(message);
            };
            const config = {fps: 10, qrbox: 250, aspectRatio: 1};
            html5QrCode.start({facingMode: 'environment'}, config, qrCodeSuccessCallback);
            });
</script> --}}

@endsection

@section('js')
<script src="html5-qrcode.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    // function onScanSuccess(decodedText, decodedResult) {
    //             console.log(`Code matched = ${decodedText}`, decodedResult);
    //             }


                function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                console.warn(`Code scan error = ${error}`);
                }

                let html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader",
                    { fps: 10, qrbox: {width: 250, height: 250} },
                    /* verbose= */ false);

                // html5QrcodeScanner.render(onScanSuccess, onScanFailure);

                // ************************************************************

                    function onScanSuccess(decodedText, decodedResult) {
                    // Handle on success condition with the decoded text or result.
                    console.log(`Scan result: ${decodedText}`, decodedResult);
                        // axios.get('/dashboard/shipment/scan/' + decodedText);
                    $(function() {
                        // $("input").hide();
                       document.getElementById("myInput").value = decodedText ;
                       document.getElementById("myFunction").submit();
                    });

                    // $(function() {
                    //     axios.post('/dashboard/shipment/scan', {
                    //         firstName : document.getElementById("myInput").value ,
                    //     })
                    //     .then(function (response) {
                    //     console.log(response);
                    //     })
                    //     .catch(function (error) {
                    //     console.log(error.response.data.message);
                    //     });

                    // });


                    html5QrcodeScanner.clear();
                    // ^ this will stop the scanner (video feed) and clear the scan area.
                    }

                    html5QrcodeScanner.render(onScanSuccess);

                    // **************************************************

</script>

@endsection
