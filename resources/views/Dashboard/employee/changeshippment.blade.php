@extends('Dashboard.app')

@section('title','')

@section('page_name','Change Shippment Status')


@section('pages')

@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
{{--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

@endsection

@section('content')
<h1 class="text-primary" style="text-align: center;margin-bottom: 20px;">Scan Barcode
</h1>

{{-- message if the barcode shippment does not exist --}}
{{-- @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif --}}
{{-- ================================================ --}}

<div class="form-group">
    <label for="">{{ __('site.choose_scan') }}</label>
    <select class="form-control scan_list">
        <option value="null" @if(request('type') == 'null') selected @endif>{{  __('site.choose_scan') }}</option>
        <option value="camera" @if(request('type') == 'camera') selected @endif>{{ __('site.camera_scan') }}</option>
        <option value="device" @if(request('type') == 'device') selected @endif>{{ __('site.device_scan') }}</option>
    </select>
</div>
<center>
    @if(request('type') == 'camera')
        <div style="width: 500px" id="reader"></div>
    @elseif(request('type') == 'device')
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control mt-2" name="sometext" id="myInput">
                </div>
                <div class="col-12 col-md-2">
                    <button class="btn w-100 btn-primary mt-2" id="add_shipment">{{ __('site.add') }}</button>
                </div>
            </div>
        </div>
    @endif
</center>
<br>
<div class="container">

    <div class="row">


        <div class="col-sm">

            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead class="table-light" id="th1" style="display: none">
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th class="w-10px pe-2">shipment</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider" id="container">

                </tbody>
            </table>
        </div>

        <div class="col-sm">
            <label id="driver_name" style="display: none"
                class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.status')}}</label>
            <select name="shipment_type" id="status" style="display: none" data-placeholder="date_period"
                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                <option value="" disabled selected>Select Status ..
                </option>

                <option value="receiver_at_hub">Receiver At Hub</option>
                <option value="out_for_delivery">Out For Delivery</option>


            </select><br>

            <form>
                @csrf
                <button type="button" id="button" onclick="addshipment()" class="btn btn-primary"
                    style="display: none">Submit</button>
            </form>
        </div>

    </div>
</div>

@endsection

@section('js')
{{-- <script src="html5-qrcode.min.js"></script> --}}
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    // =============================================================================
    $(".scan_list").on('change', function() {
        location.href = '/dashboard/scan/shippments/status?type=' + $(this).val();
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'you are using ' + $(this).val(),
            showConfirmButton: false,
            timer: 1500
        });
    });
    const cars = [];
    let count = 1;
    @if(request('type') == 'device')
        $("#myInput").focus();
        $("#add_shipment").on('click', function() {
            cars.push($("#myInput").val());
            console.log($("#myInput").val());
            $("#container").append(`
                <tr>
                    <td>${count}</td>
                    <td>${$("#myInput").val()}</td>
                </tr>
            `);
            document.getElementById("th1").style.display = '' ;
            document.getElementById("button").style.display = '' ;
            document.getElementById("status").style.display = '' ;
            document.getElementById("driver_name").style.display = '' ;
            const audio = new Audio();
            audio.src = "{{asset('assets/sound/Barcode-scanner-beep-sound.mp3')}}";
            audio.play();
            $("#myInput").val('');
            $("#myInput").focus();
            count++;
        });
    @endif

    @if(request('type') == 'camera')
        function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        // console.log(`Scan result: ${decodedText}`, decodedResult);
        console.log(decodedText);
        console.log($('meta[name="csrf-token"]').attr('content'))
            cars.push(decodedText);
            $(document).ready(function() {
                    $("#container").append("<tr>");
                    $("#container").append("<td>"+ count +"</td>");
                    $("#container").append("<td>"+decodedText+"</td>");
                    $("#container").append("</tr>");
                    document.getElementById("th1").style.display = '' ;
                    document.getElementById("button").style.display = '' ;
                    document.getElementById("status").style.display = '' ;
                    document.getElementById("driver_name").style.display = '' ;
            });

            $('document').ready(function() {
                const audio = new Audio();
                audio.src = "{{asset('assets/sound/Barcode-scanner-beep-sound.mp3')}}";
                audio.play();
            });
            count++;
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 1, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    @endif

    // =============================================================================
        function addshipment() {
            axios.post('/dashboard/employee/scan/shippments', {
                arr:cars,
                // sh_status: status,
                status: document.getElementById('status').value,
                // email: document.getElementById('email').value,
                // phone: document.getElementById('phone').value,
                // password: document.getElementById('password').value,
                // password_confirmation: document.getElementById('password_confirmation').value,
                // special_pickup: document.getElementById('special_pickup').value,
            })
            .then(function (response) {
                //2xx
                console.log(response);
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500
                });
                location.reload();

            })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: error.response.data.message,
                showConfirmButton: false,
                timer: 1500
                });

            });
        }

</script>

@endsection
