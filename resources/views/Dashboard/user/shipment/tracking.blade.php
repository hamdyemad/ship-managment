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
    ol.progtrckr {
        margin: 0;
        padding: 0;
        list-style-type none;
    }

    ol.progtrckr li {
        display: inline-block;
        text-align: center;
        line-height: 3.5em;
    }

    ol.progtrckr[data-progtrckr-steps="2"] li {
        width: 49%;
    }

    ol.progtrckr[data-progtrckr-steps="3"] li {
        width: 33%;
    }

    ol.progtrckr[data-progtrckr-steps="4"] li {
        width: 24%;
    }

    ol.progtrckr[data-progtrckr-steps="5"] li {
        width: 19%;
    }

    ol.progtrckr[data-progtrckr-steps="6"] li {
        width: 16%;
    }

    ol.progtrckr[data-progtrckr-steps="7"] li {
        width: 14%;
    }

    ol.progtrckr[data-progtrckr-steps="8"] li {
        width: 12%;
    }

    ol.progtrckr[data-progtrckr-steps="9"] li {
        width: 11%;
    }

    ol.progtrckr li.progtrckr-done {
        color: black;
        border-bottom: 4px solid yellowgreen;
    }

    ol.progtrckr li.progtrckr-todo {
        color: silver;
        border-bottom: 4px solid silver;
    }

    ol.progtrckr li:after {
        content: "\00a0\00a0";
    }

    ol.progtrckr li:before {
        position: relative;
        bottom: -2.5em;
        float: left;
        left: 50%;
        line-height: 1em;
    }

    ol.progtrckr li.progtrckr-done:before {
        content: "\2713";
        color: white;
        background-color: yellowgreen;
        height: 2.2em;
        width: 2.2em;
        line-height: 2.2em;
        border: none;
        border-radius: 2.2em;
    }

    ol.progtrckr li.progtrckr-todo:before {
        content: "\039F";
        color: silver;
        background-color: white;
        font-size: 2.2em;
        bottom: -1.2em;
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
            <h3 class="fw-bolder m-0">{{ __('site.tracking') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <div class="card mb-5 mb-xl-10">
            <section class="root">
                <div class="order-track">
                @foreach ($tracking as $tracking)
                    <div class="order-track-step">
                        <div class="order-track-status">
                        <span class="order-track-status-dot"></span>
                        <span class="order-track-status-line"></span>
                        </div>
                        <div class="order-track-text">
                        <p class="order-track-text-stat">{{ $tracking->status }}</p>
                        <span class="order-track-text-sub">{{ \Carbon\Carbon::parse($tracking->created_at)->format('Y-m-d / h:i:s') }}</span>
                        </div>
                  </div>
                @endforeach
                </div>
            </section>

            {{-- <div class="progress-track">
                <ul id="progressbar">
                    @if (!$tracking->isEmpty())

                    {{$tracking->count()}}
                    @foreach ($tracking as $tracking)
                    <li class="active step" id="step1">{{$tracking->status}} <br>
                        {{$tracking->created_at}}</li>

                    @endforeach

                    @else
                    <li class="active step0 text-center" id="step1">created</li>
                    <li class=" step0 text-center" id="step1">Shipped</li>
                    <li class=" step0 text-center" id="step1">Delivered</li>
                    @endif


                </ul>

            </div> --}}


        </div>

    </div>
    <!--end::Content-->

</div>

@endsection

@section('js')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



@endsection
