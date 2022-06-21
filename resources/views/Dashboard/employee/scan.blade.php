@extends('Dashboard.app')

@section('title','assign')

@section('page_name','assign shippments')


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
                class="col-lg-4 col-form-label required fw-bold fs-6">{{__('site.driver')}}</label>
            <select name="shipment_type" id="driver_id" style="display: none" data-placeholder="date_period"
                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                <option value="" disabled selected>Select Driver ..
                </option>
                @foreach ($drivers as $driver)
                <option value="{{$driver->id}}">{{$driver->name}} </option>
                @endforeach
            </select><br>

            <form>
                @csrf
                <button type="button" id="button" class="btn btn-primary" style="display: none">Submit</button>
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
                    document.getElementById("driver_id").style.display = '' ;
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#button").click(function(e){

            e.preventDefault();
            $.ajax({
                type:'POST',
                url:"{{ route('scan2') }}",
                data:{
                    arr:cars,
                    driver_id :document.getElementById("driver_id").value,
                },
                success:function(data){
                    console.log('success');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Shippment assigned successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                },error: function (reject) {
                    console.log(reject.error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'assigned failed!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });

        });

</script>

@endsection
