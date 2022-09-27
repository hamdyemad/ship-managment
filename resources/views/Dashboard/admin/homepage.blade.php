@extends('Dashboard.app')

@section('title',__('site.dashboard'))

@section('page_name',__('site.dashboard'))

@section('pages')

<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('app')}}" class="text-muted text-hover-primary">{{__('site.home')}}</a>
    </li>
    <!--end::Item-->


</ul>

@endsection

@section('css')

@endsection

@section('content')

<!--begin::Post-->
{{-- <div class="post d-flex flex-column-fluid" id="kt_post"> --}}
    <!--begin::Container-->
    {{-- <div id="kt_content_container" class="container-xxl"> --}}
        <!--begin::Row-->
        <!--begin::Mixed Widget 2-->
        <div class="card card-xxl-stretch dashboard">
            <!--begin::Header-->

            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0">
                <!--begin::Stats-->
                <div class="card-p">

                    <!--begin::Row-->
                    <div class="row justify-content-center">
                        @if(Auth::guard('admin')->check())
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="item bg-light-primary px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <i class="bi bi-people"></i>
                                        </span>
                                        <h2 class="text-muted">{{ $employees }}</h2>
                                    </div>
                                    <!--end::Svg Icon-->
                                    <a href="#" class="text-primary fw-bold fs-6">{{ __('site.employees') }}</a>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="item bg-light-primary px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <i class="bi bi-people"></i>
                                        </span>
                                        <h2 class="text-muted">{{ $sellers }}</h2>
                                    </div>
                                    <!--end::Svg Icon-->
                                    <a href="#" class="text-primary fw-bold fs-6">{{ __('site.sellers') }}</a>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="item bg-light-primary px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <i class="bi bi-people"></i>
                                        </span>
                                        <h2 class="text-muted">{{ $drivers }}</h2>
                                    </div>
                                    <!--end::Svg Icon-->
                                    <a href="#" class="text-primary fw-bold fs-6">{{ __('site.drivers') }}</a>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="item bg-light-success px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                            <i class="bi bi-cash-stack"></i>
                                        </span>
                                        <h2 class="text-muted">{{ $settled_sellers_prices }}</h2>
                                    </div>
                                    <!--end::Svg Icon-->
                                    <a href="#" class="text-success fw-bold fs-6">{{ __('site.paid_shippments') }}</a>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="item bg-light-success px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                            <i class="bi bi-cash-stack"></i>
                                        </span>
                                        <h2 class="text-muted">{{ $sellers_should_to_pays }}</h2>
                                    </div>
                                    <!--end::Svg Icon-->
                                    <a href="#" class="text-success fw-bold fs-6">{{ __('site.sellers_should_to_pays') }}</a>
                                </div>
                            </div>
                            <!--end::Col-->
                        @endif
                    </div>
                    <!--end::Row-->

                </div>
                <!--end::Stats-->
                <!--begin::Chart-->
                <canvas id="myChart"></canvas>
                <!--end::Chart-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 2-->
        {{-- <div class="row gy-5 g-xl-8">

            <!--begin::Col-->
            <div class="col-xxl-4">
                <!--begin::Mixed Widget 7-->
                <div class="card card-xxl-stretch-50 mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <!--begin::Stats-->
                        <div class="flex-grow-1 card-p pb-0">
                            <div class="d-flex flex-stack flex-wrap">
                                <div class="me-2">
                                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Generate Reports</a>
                                    <div class="text-muted fs-7 fw-bold">Finance and accounting reports</div>
                                </div>
                                <div class="fw-bolder fs-3 text-primary">$24,500</div>
                            </div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Chart-->
                        <div class="mixed-widget-7-chart card-rounded-bottom" data-kt-chart-color="primary"
                            style="height: 150px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 7-->
                <!--begin::Mixed Widget 10-->
                <div class="card card-xxl-stretch-50 mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
                        <!--begin::Hidden-->
                        <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
                            <div class="me-2">
                                <span class="fw-bolder text-gray-800 d-block fs-3">Sales</span>
                                <span class="text-gray-400 fw-bold">Oct 8 - Oct 26 21</span>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">$15,300</div>
                        </div>
                        <!--end::Hidden-->
                        <!--begin::Chart-->
                        <div class="mixed-widget-10-chart" data-kt-color="primary" style="height: 175px"></div>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Mixed Widget 10-->
            </div>
            <!--end::Col-->
        </div> --}}
        <!--end::Row-->
        {{--
    </div> --}}
    <!--end::Container-->
    {{--
</div> --}}
<!--end::Post-->

@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Created','Delivered', 'Out For Delivery', 'Rejected', 'Rejected Fees Paid', 'Receiver at hub'],
        datasets: [{
            // label: '# of Votes',
            data: [{{ $created }} ,{{ $delivered }}, {{ $out_for_delivery }}, {{ $rejected }}, {{ $rejected_fees_paid }}, {{ $receiver_at_hub }}],
            backgroundColor: [
                '#80c5f1',
                '#6cda6c',
                '#dab46c',
                '#ac1f1f',
                '#681010',
                '#c1a11f',
            ],
            // borderColor: [
            //     'rgba(255, 99, 132, 1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            //     'rgba(75, 192, 192, 1)',
            //     'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)'
            // ],
            // borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
{{-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script> --}}

@endpush
