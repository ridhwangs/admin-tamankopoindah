<?php 
use Carbon\Carbon;
use App\Models\Parkir;
use App\Models\ParkirLocal;
?>
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
    
    <div class="container-fluid general-widget mb-5" id="dashboard">
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <h3>Last Sync On : {{ $log_sync->created_at }} - {{ request()->ip() }}</h3>
                <div class="card o-hidden border-0">
                    <div class="card-header">
                        <div class="header-top">
                            <h6>Filter Dashboard </h6>
                        </div>
                        <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li><i class="icofont icofont-refresh font-primary" onclick="reload_dashboard();"></i></li>
                                </ul>
                            </div>
                    </div>
                    <div class="card-body p-t-0 mb-0">
                        <form class="row g-3 mb-0">
                            <div class="col-auto">
                                <label for="tanggal" class="visually-hidden">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="col-auto">
                                <label for="operator_id" class="visually-hidden">Operator</label>
                                <select class="form-control" name="operator_id" id="operator_id">
                                    <option value="">Tampilkan Semua</option>
                                    @foreach($filter_operator_dashboard AS $key => $rows)
                                        <option value="{{ $rows->operator_id }}">{{ $rows->operator->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="operator_id" class="visually-hidden">Shift</label>
                                <select class="form-control" name="shift_id" id="shift_id">
                                    <option value="">Semua Shift</option>
                                    @foreach($filter_shift_dashboard AS $key => $rows)
                                        <option value="{{ $rows->shift_id }}">{{ $rows->shift->nama_shift }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="arrow-up"></i></div>
                            <div class="media-body">
                                <span class="m-0">Tiket Tercetak</span>
                                <h4 class="mb-0 non-counter" id="tiket_tercetak_all"></h4>
                             
                                <ul class="small">
                                    @php
                                        $tiket_tercetak_today = 0; 
                                    @endphp
                                    @foreach($tiket_tercetak_detail AS $key => $rows)
                                        <li>{{ str_replace('_',' ',$rows->kategori) }}: {{ $rows->qty_cetak }}</li>
                                        
                                    @php
                                        $tiket_tercetak_today += $rows->qty_cetak; 
                                    @endphp
                                    @endforeach
                                </ul>
                             
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
                                <h4 class="mb-0 non-counter" id="tiket_keluar_all"></h4>
                                <ul class="small">
                                    @php
                                        $tiket_keluar_today = 0; 
                                    @endphp
                                    @foreach($tiket_keluar_detail AS $key => $rows)
                                        <li>{{ str_replace('_',' ',$rows->kategori) }}: {{ $rows->qty_cetak }}</li>
                                    @php
                                        $tiket_keluar_today += $rows->qty_cetak; 
                                    @endphp
                                    @endforeach
                                </ul>
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
                                <h4 class="mb-0 non-counter">{{ $tiket_tercetak_today - $tiket_keluar_today }}</h4>
                                <ul class="small">
                               
                                    @foreach($tiket_tercetak_detail AS $key => $rows)
                                        @php
                                        $today = Carbon::today();
                                        if(!empty(request()->query('tanggal'))){
                                            $today = request()->query('tanggal');
                                        }
                                        $where = [
                                            'kategori' => $rows->kategori,
                                            'status' => 'keluar'
                                        ];
                                        $tiket_keluar = Parkir::groupBy('kategori')->where($where)->whereDate('check_in',$today)->count();
                                        @endphp
                                        <li>{{ str_replace('_',' ',$rows->kategori) }}: {{ $rows->qty_cetak - $tiket_keluar }}</li>
                                    @endforeach
                                </ul>
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
                                <h4 class="mb-0 non-counter" id="tiket_expired_all"></h4>
                                <ul>
                                    @php
                                        $tiket_expired_today = 0; 
                                    @endphp
                                    @foreach($tiket_expired AS $key => $rows)
                                        <li>{{ str_replace('_',' ',$rows->kategori) }}: {{ $rows->qty_cetak }}</li>
                                        @php
                                            $tiket_expired_today += $rows->qty_cetak;
                                        @endphp
                                    @endforeach
                                </ul>
                                <i class="icon-bg" data-feather="alert-octagon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- for local only -->
            @if((request()->ip() == '127.0.0.1') || (request()->ip() == '::1'))
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="arrow-up"></i></div>
                            <div class="media-body">
                                <span class="m-0">Tiket Tercetak Local</span>
                                <h4 class="mb-0 non-counter" id="tiket_tercetak_local"></h4>
                             
                                <ul class="small">
                                    @php
                                        $tiket_tercetak_today_local = 0; 
                                    @endphp
                                    @foreach($tiket_tercetak_local AS $key => $rows)
                                        <li>{{ str_replace('_',' ',$rows->kategori) }}: {{ $rows->qty_cetak }}</li>
                                        
                                    @php
                                        $tiket_tercetak_today_local += $rows->qty_cetak; 
                                    @endphp
                                    @endforeach
                                </ul>
                             
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
                                <span class="m-0">Tiket Keluar Local</span>
                                <h4 class="mb-0 non-counter" id="tiket_keluar_local"></h4>
                                <ul class="small">
                                    @php
                                        $tiket_keluar_today_local = 0; 
                                    @endphp
                                    @foreach($tiket_keluar_local AS $key => $rows)
                                        <li>{{ str_replace('_',' ',$rows->kategori) }}: {{ $rows->qty_cetak }}</li>
                                    @php
                                        $tiket_keluar_today_local += $rows->qty_cetak; 
                                    @endphp
                                    @endforeach
                                </ul>
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
                                <span class="m-0">Tiket Sisa Local</span>
                                <h4 class="mb-0 non-counter">{{ $tiket_tercetak_today_local - $tiket_keluar_today_local }}</h4>
                                <ul class="small">
                               
                                    @foreach($tiket_tercetak_local AS $key => $rows)
                                        @php
                                        $today = Carbon::today();
                                        if(!empty(request()->query('tanggal'))){
                                            $today = request()->query('tanggal');
                                        }
                                        $where = [
                                            'kategori' => $rows->kategori,
                                            'status' => 'keluar'
                                        ];
                                        $tiket_keluar = ParkirLocal::groupBy('kategori')->where($where)->whereDate('check_in',$today)->count();
                                        @endphp
                                        <li>{{ str_replace('_',' ',$rows->kategori) }}: {{ $rows->qty_cetak - $tiket_keluar }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <a href="{{ route('posting') }}" class="btn btn-primary">Posting Data</a>
                </div>
            </div>
            @endif
            <!-- end for local only -->
            
            <div class="col-xl-12 xl-100 box-col-12">
                <div class="widget-joins card widget-arrow">
                    <div class="row">
                        <div class="col-sm-6 pe-0">
                            <div class="media border-after-xs">
                                <div class="align-self-center me-3 text-start">
                                    <span class="widget-t mb-1">Pendapatan</span>
                                    <h5 class="mb-0">{{ !empty(request()->query('tanggal')) ? date('d F Y', strtotime(request()->query('tanggal'))) : date('d F Y') }}</h5>
                                </div>
                                <div class="media-body align-self-center"></div>
                                <div class="media-body">
                                    <table class="table table-xs">
                                        @php
                                            $sum_hari_ini = 0; 
                                        @endphp
                                        @foreach($hari_ini AS $key => $rows)
                                            <tr>
                                                <td>{{ $rows->kendaraan->nama_kendaraan }}</td> 
                                                <td>{{ number_format($rows->sum) }}</td>
                                            </tr>
                                        
                                        @php
                                            $sum_hari_ini += $rows->sum; 
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td>Total</td>
                                            <td><b>{{ number_format($sum_hari_ini) }}</b></td>
                                        </tr>
                                    </table>
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
                                <table class="table table-xs">
                                        @php
                                            $sum_minggu_ini = 0; 
                                        @endphp
                                        @foreach($minggu_ini AS $key => $rows)
                                            <tr>
                                                <td>{{ $rows->kendaraan->nama_kendaraan }}</td> 
                                                <td>{{ number_format($rows->sum) }}</td>
                                            </tr>
                                        
                                        @php
                                            $sum_minggu_ini += $rows->sum; 
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td>Total</td>
                                            <td><b>{{ number_format($sum_minggu_ini) }}</b></td>
                                        </tr>
                                    </table>
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
                                    <table class="table table-xs">
                                        @php
                                            $sum_bulan_ini= 0; 
                                        @endphp
                                        @foreach($bulan_ini AS $key => $rows)
                                            <tr>
                                                <td>{{ $rows->kendaraan->nama_kendaraan }}</td> 
                                                <td>{{ number_format($rows->sum) }}</td>
                                            </tr>
                                        
                                        @php
                                            $sum_bulan_ini += $rows->sum; 
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td>Total</td>
                                            <td><b>{{ number_format($sum_bulan_ini) }}</b></td>
                                        </tr>
                                    </table>
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
                                <table class="table table-xs">
                                        @php
                                            $sum_tahun_ini = 0; 
                                        @endphp
                                        @foreach($tahun_ini AS $key => $rows)
                                            <tr>
                                                <td>{{ $rows->kendaraan->nama_kendaraan }}</td> 
                                                <td>{{ number_format($rows->sum) }}</td>
                                            </tr>
                                        
                                        @php
                                            $sum_tahun_ini += $rows->sum; 
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td>Total</td>
                                            <td><b>{{ number_format($sum_tahun_ini) }}</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Gate</th>
                                        <th>Printer</th>
                                        <th>Sisa Kertas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($master_gate AS $key => $rows)
                                        <tr>
                                            <td>{{ $rows->nama }}</td>
                                            <td>{{ $rows->nama_printer }}</td>
                                            <td>@if($rows->kuota < 50) <i class="fa fa-warning"></i> @endif {{ $rows->kuota }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 box-col-8 des-xl-100 top-dealer-sec">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Log Aktivitas.</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="min-height:155px;background-color:white; height:155px; overflow-y: auto;">
                            <table class="table table-bordernone table-xs" >
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
        <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
        <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
        <script src="{{asset('assets/js/owlcarousel/owl-custom.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/dashboard_2.js')}}"></script>
        <script>
            $("#tiket_tercetak_all").html("{{ $tiket_tercetak_today }}");
            @if((request()->ip() == '127.0.0.1') || (request()->ip() == '::1'))
            $("#tiket_tercetak_local").html("{{ $tiket_tercetak_today_local }}");
            $("#tiket_keluar_local").html("{{ $tiket_keluar_today_local }}");
            @endif
            $("#tiket_keluar_all").html("{{ $tiket_keluar_today }}");
            $("#tiket_expired_all").html("{{ $tiket_expired_today }}");
            $("#tanggal").val('{{ !empty(request()->query('tanggal')) ? request()->query('tanggal') : date('Y-m-d') }}');
            $("#operator_id").val('{{ request()->query('operator_id') }}');
            $("#shift_id").val('{{ request()->query('shift_id') }}');

            function reload_dashboard() {
                location.reload();
            }
        </script>
    @endpush
@endsection