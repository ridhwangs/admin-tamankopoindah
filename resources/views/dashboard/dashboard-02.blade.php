@extends('layouts.admin.master')

@section('title')Dashboard {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
@endpush
    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 box-col-12 des-xl-100 invoice-sec">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Parkir hari ini.</h5>
                            <div class="center-content">
                                <p class="d-sm-flex align-items-center"><span class="m-r-10">$5,56548k</span><i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>94% More Than Last Year</p>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <!-- <li>
                                        <div class="setting-primary"><i class="icon-settings"></i></div>
                                    </li> -->
                                    <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="timeline-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 box-col-12 des-xl-100 top-dealer-sec">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Log Hari Ini.</h5>
                           
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xs">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Operator</th>
                                        <th>Shift</th>
                                        <th>Keterangan</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($log AS $key => $rows)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $rows->operator->nama }}</td>
                                            <td>{{ $rows->shift->nama_shift }}</td>
                                            <td>{{ $rows->keterangan }}</td>
                                            <td>{{ $rows->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 des-xl-50 yearly-growth-sec">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Yearly growth</h5>
                            <div class="center-content">
                                <p class="d-sm-flex align-items-center"><span class="m-r-10"><i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>$9657.55k </span>86% more then last year</p>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-primary"><i class="icon-settings"></i></div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-primary"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                                    <li><i class="icofont icofont-error close-card font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 chart-block">
                        <div id="chart-yearly-growth-dash-2"></div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#yearly-growth" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')    
        <script src="{{asset('assets/js/chart/chartjs/chart.min.js')}}"></script>
        <script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
        <script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
        <script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
        <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
        <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
        <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
        <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
        <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
        <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
        <script src="{{asset('assets/js/owlcarousel/owl-custom.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/dashboard_2.js')}}"></script>
    @endpush
@endsection