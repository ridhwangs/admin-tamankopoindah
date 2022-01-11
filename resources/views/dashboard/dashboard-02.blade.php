@extends('layouts.admin.master')

@section('title')Ecommerce {{ $title }}
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
                            <h5>Invoice Overview    </h5>
                            <div class="center-content">
                                <p class="d-sm-flex align-items-center"><span class="m-r-10">$5,56548k</span><i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>94% More Than Last Year</p>
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
                                    <li><i class="icofont icofont-error close-card font-primary"> </i></li>
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
                            <h5>Top Dealer</h5>
                            <div class="center-content">
                                <p class="d-sm-flex align-items-center"><span class="m-r-10">845 Dealer</span><i class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>86% More Than Last Year</p>
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
                                    <li><i class="icofont icofont-error close-card font-primary"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="owl-carousel owl-theme" id="owl-carousel-14">
                            <div class="item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/1.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Johnson allon</h6>
                                                        <p>Bangladesh</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/3.png')}}" alt="...">
                                                        <h6>williams reed</h6>
                                                        <p>Belgium</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/4.png')}}" alt="...">
                                                        <h6> Jones king</h6>
                                                        <p>Canada</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/5.png')}}" alt="...">
                                                        <h6>Brown davis</h6>
                                                        <p>China</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/6.png')}}" alt="...">
                                                        <h6>Wilson Hill</h6>
                                                        <p>Denmark</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/7.png')}}" alt="...">
                                                        <h6>Anderson ban</h6>
                                                        <p>Japan</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/1.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Johnson allon</h6>
                                                        <p>Bangladesh</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/3.png')}}" alt="...">
                                                        <h6>williams reed</h6>
                                                        <p>Belgium</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/4.png')}}" alt="...">
                                                        <h6> Jones king</h6>
                                                        <p>Canada</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/5.png')}}" alt="...">
                                                        <h6>Brown davis</h6>
                                                        <p>China</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/6.png')}}" alt="...">
                                                        <h6>Wilson Hill</h6>
                                                        <p>Denmark</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/7.png')}}" alt="...">
                                                        <h6>Anderson ban</h6>
                                                        <p>Japan</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/1.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Johnson allon</h6>
                                                        <p>Bangladesh</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/3.png')}}" alt="...">
                                                        <h6>williams reed</h6>
                                                        <p>Belgium</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/4.png')}}" alt="...">
                                                        <h6> Jones king</h6>
                                                        <p>Canada</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/5.png')}}" alt="...">
                                                        <h6>Brown davis</h6>
                                                        <p>China</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/6.png')}}" alt="...">
                                                        <h6>Wilson Hill</h6>
                                                        <p>Denmark</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/7.png')}}" alt="...">
                                                        <h6>Anderson ban</h6>
                                                        <p>Japan</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/1.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Johnson allon</h6>
                                                        <p>Bangladesh</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/3.png')}}" alt="...">
                                                        <h6>williams reed</h6>
                                                        <p>Belgium</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/4.png')}}" alt="...">
                                                        <h6> Jones king</h6>
                                                        <p>Canada</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="owl-carousel-16 owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/5.png')}}" alt="...">
                                                        <h6>Brown davis</h6>
                                                        <p>China</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/6.png')}}" alt="...">
                                                        <h6>Wilson Hill</h6>
                                                        <p>Denmark</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/7.png')}}" alt="...">
                                                        <h6>Anderson ban</h6>
                                                        <p>Japan</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="card">
                                                    <div class="top-dealerbox text-center">
                                                        <img class="card-img-top" src="{{asset('assets/images/dashboard-2/8.png')}}" alt="...">
                                                        <h6>Thompson lee</h6>
                                                        <p>Malasiya</p>
                                                        <a class="btn btn-rounded" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#top-dealer" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                            
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