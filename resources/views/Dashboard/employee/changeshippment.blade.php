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

<center>
    <div style="width: 500px" id="reader"></div>
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

                <option value="receiver at hub">receiver at hub</option>
                <option value="shipped">shipped</option>
                <option value="delivered">delivered</option>

                <option value="rejected">rejected</option>
                <option value="rejected_fees_faid">rejected fees faid</option>


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
<script src="html5-qrcode.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    // =============================================================================
    const cars = [];
    let count = 0 ;
        function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        // console.log(`Scan result: ${decodedText}`, decodedResult);

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

    // =============================================================================

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // $("#button").click(function(e){

        //     e.preventDefault();
        //     $.ajax({
        //         type:'POST',
        //         url:"{{ route('scan2') }}",
        //         data:{
        //             arr:cars,
        //             driver_id :document.getElementById("driver_id").value,
        //         },
        //         success:function(data){
        //             console.log('success');
        //                 Swal.fire({
        //                     position: 'top-end',
        //                     icon: 'success',
        //                     title: 'Shippment assigned successfully',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //         },error: function (reject) {
        //             console.log(reject.error);
        //             Swal.fire({
        //                 position: 'top-end',
        //                 icon: 'error',
        //                 title: 'assigned failed!',
        //                 showConfirmButton: false,
        //                 timer: 1500
        //             });
        //         }
        //     });

        // });

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
                // document.getElementById('kt_account_profile_details_form').reset();
                // window.location.href = "/dashboard/driver";

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
