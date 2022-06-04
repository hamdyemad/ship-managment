@extends('Dashboard.app')

@section('title',__('site.tracking'))

@section('page_name',__('site.tracking'))


@section('pages')

<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('app')}}" class="text-muted text-hover-primary">{{__('site.home')}}</a>
    </li>
    <!--end::Item-->

    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('shipment.index')}}" class="text-muted text-hover-primary">{{__('site.shipment')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->

    <li class="breadcrumb-item text-muted">
        <a href="" class="text-muted text-hover-primary">{{__('site.tracking')}}</a>
    </li>
    <!--end::Item-->
</ul>

@endsection

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    body {
        /* color: #000; */
        /* overflow-x: hidden; */
        /* height: 100%; */
        /* background-color: #8C9EFF; */
        /* background-repeat: no-repeat; */
    }

    .card {
        z-index: 0;
        background-color: #ECEFF1;
        /* padding-bottom: 20px;
        margin-top: 90px;
        margin-bottom: 90px;
        border-radius: 10px; */
    }

    .top {
        padding-top: 40px;
        padding-left: 13% !important;
        padding-right: 13% !important;
    }

    /*Icon progressbar*/
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455A64;
        padding-left: 0px;
        margin-top: 30px;
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
    }

    #progressbar .step0:before {
        font-family: FontAwesome;
        content: "\f10c";
        color: #fff;
    }

    #progressbar li:before {
        width: 40px;
        height: 40px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        background: #C5CAE9;
        border-radius: 50%;
        margin: auto;
        padding: 0px;
    }

    /*ProgressBar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 12px;
        background: #C5CAE9;
        position: absolute;
        left: 0;
        top: 16px;
        z-index: -1;
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        position: absolute;
        left: -50%;
    }

    #progressbar li:nth-child(2):after,
    #progressbar li:nth-child(3):after {
        left: -50%;
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        position: absolute;
        left: 50%;
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    /*Color number of the step and the connector before it*/
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #956af3;
    }

    #progressbar li.active:before {
        font-family: FontAwesome;
        content: "\f00c";
    }

    .icon {
        width: 60px;
        height: 60px;
        margin-right: 15px;
    }

    .icon-content {
        padding-bottom: 20px;
    }

    @media screen and (max-width: 992px) {
        .icon-content {
            width: 50%;
        }
    }
</style>
@endsection

@section('content')

<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Tracking Order</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <div class="card mb-5 mb-xl-10">
            {{-- <div class="title">Purchase Reciept</div> --}}
            {{-- <div class="info">
                <div class="row">
                    <div class="col-7">
                        <span id="heading">Date</span><br>
                        <span id="details">10 October 2018</span>
                    </div>
                    <div class="col-5 pull-right">
                        <span id="heading">Order No.</span><br>
                        <span id="details">012j1gvs356c</span>
                    </div>
                </div>
            </div> --}}



            <div class="progress-track">
                <ul id="progressbar">
                    @if (!$tracking->isEmpty())
                    @foreach ($tracking as $tracking)
                    <li class="active step0  text-center " id="step1">{{$tracking->status}} <br>
                        {{$tracking->created_at}}</li>
                    @endforeach

                    @else
                    <li class="active step0 text-center" id="step1">created</li>
                    <li class=" step0 text-center" id="step1">Shipped</li>
                    <li class=" step0 text-center" id="step1">Delivered</li>
                    @endif


                </ul>
            </div>


        </div>

    </div>
    <!--end::Content-->

</div>

@endsection

@section('js')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    //show city and his area in select tag
        $(document).ready(function(){

            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{ route('dynamicdependent.fetch') }}",
                method:"POST",
                data:{select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                $('#'+ dependent).html(result);
                }

                })
                }
            });

                $('#city').change(function(){
                $('#area').val('');

                });

        });

        //add shipment details
        function addshipment() {

            $("#togBtn").on('change', function() {
            if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
            }
            else {
            $(this).attr('value', 'false');
            }});
            axios.post('/dashboard/shipment', {
                user_id:{{auth()->user()->id}},
                area: document.getElementById('area').value,
                city: document.getElementById('city').value,
                shipment_type: document.getElementById('shipment_type').value,
                business: document.getElementById('business').value,
                receiver_name: document.getElementById('receiver_name').value,
                receiver_phone: document.getElementById('receiver_phone').value,
                address: document.getElementById('address').value,
                package:document.getElementById('package').value,
                price:document.getElementById('price').value,
                note:document.getElementById('note').value,
                active:document.getElementById('togBtn').value,
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
                document.getElementById('kt_account_profile_details_form').reset();

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
