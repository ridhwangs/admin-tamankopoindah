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
    
    <div class="container-fluid general-widget mb-5">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="arrow-up"></i></div>
                            <div class="media-body">
                                <span class="m-0">Tiket Tercetak</span>
                                <h4 class="mb-0 counter">{{ $tiket_tercetak }}</h4>
                                <small>Hari ini: <span class="counter">{{ $tiket_tercetak_today }}</span></small>
                             
                                <i class="icon-bg" data-feather="arrow-up"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-warning b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="arrow-down"></i></div>
                            <div class="media-body">
                                <span class="m-0">Tiket Keluar</span>
                                <h4 class="mb-0 counter">{{ $tiket_keluar }}</h4>
                                <small>Hari ini: <span class="counter">{{ $tiket_keluar_today }}</span></small>
                                <i class="icon-bg" data-feather="arrow-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-secondary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                            <div class="media-body">
                                <span class="m-0">Tiket Sisa</span>
                                <h4 class="mb-0 counter">{{ $tiket_tercetak - $tiket_keluar }}</h4>
                                <small>Hari ini: <span class="counter">{{ $tiket_tercetak_today - $tiket_keluar_today }}</span></small>
                                <i class="icon-bg" data-feather="archive"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-danger b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="alert-octagon"></i></div>
                            <div class="media-body">
                                <span class="m-0">Tiket Expired</span>
                                <h4 class="mb-0 counter">{{ $tiket_expired }}</h4>
                                <small>Hari ini: <span class="counter">{{ $tiket_expired_today }}</span></small>
                                <i class="icon-bg" data-feather="alert-octagon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-6 xl-100 box-col-12">
                <div class="widget-joins card widget-arrow">
                    <div class="row">
                        <div class="col-sm-6 pe-0">
                            <div class="media border-after-xs">
                                <div class="align-self-center me-3 text-start">
                                    <span class="widget-t mb-1">Pendapatan</span>
                                    <h5 class="mb-0">Hari ini</h5>
                                </div>
                                <div class="media-body align-self-center"></div>
                                <div class="media-body">
                                    <h5 class="mb-0">Rp.<span class="counter">{{ number_format($hari_ini) }}</span></h5>
                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 ps-0">
                            <div class="media">
                                <div class="align-self-center me-3 text-start">
                                    <span class="widget-t mb-1">Pendapatan</span>
                                    <h5 class="mb-0">Minggu ini</h5>
                                </div>
                                <div class="media-body align-self-center"></div>
                                <div class="media-body ps-2">
                                    <h5 class="mb-0">Rp.<span class="counter">{{ number_format($minggu_ini) }}</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 pe-0">
                            <div class="media border-after-xs">
                                <div class="align-self-center me-3 text-start">
                                    <span class="widget-t mb-1">Pendapatan</span>
                                    <h5 class="mb-0">Bulan ini</h5>
                                </div>
                                <div class="media-body align-self-center"></div>
                                <div class="media-body">
                                    <h5 class="mb-0">Rp.<span class="counter">{{ number_format($bulan_ini) }}</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 ps-0">
                            <div class="media">
                                <div class="align-self-center me-3 text-start">
                                    <span class="widget-t mb-1">Pendapatan</span>
                                    <h5 class="mb-0">Tahun ini</h5>
                                </div>
                                <div class="media-body align-self-center ps-3"></div>
                                <div class="media-body ps-2">
                                    <h5 class="mb-0">Rp.<span class="counter">{{ number_format($tahun_ini) }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 box-col-12 des-xl-100 top-dealer-sec">
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
                            <table class="table table-bordernone">
                                    <thead>
                                        <tr>
                                            <th scope="col">Operator</th>
                                            <th scope="col">Shift</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($log AS $key => $rows)
                                            <tr>
                                                <td class="bd-t-none u-s-tb">
                                                    <div class="align-middle image-sm-size">
                                                        <div class="d-inline-block">
                                                            <h6>{{ $rows->operator->nama }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
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