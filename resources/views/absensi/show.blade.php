@extends('layouts.admin.master')

@section('title')Absensi 
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
	 <h3> Data Absensi</h3>
		@endslot
		<li class="breadcrumb-item">Absen Mingguan</li>
    <li class="breadcrumb-item">{{ $rfid }}</li>
	@endcomponent
   
    <div class="container-fluid mb-5">
        <div class="row">
       
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            
            <div class="bookmark mb-3">
              <a href="{{ route('absensi.index') }}" class="btn btn-xs btn-danger">Kembali</a>
              <a href="{{ route('absensi.export', $rfid) }}" class="btn btn-xs rounded-0 btn-primary">EXPORT</a>
            </div>
            <div class="card">
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm table-striped table-bordered" style="white-space: nowrap;">
                    <thead class="text-center">
                      <tr>
                          <th width="1%" rowspan="2">No</th>
                          <th width="1%" rowspan="2">RFID</th>
                          <th rowspan="2">Nama</th>
                          <th colspan="2" class="bg-success">Jam Masuk</th>
                          <th colspan="2" class="bg-warning">Jam Keluar</th>
                      </tr>
                      <tr>
                        <th width="1%" class="bg-success">Tgl</th>
                        <th width="1%" class="bg-success">Jam</th>
                        
                        <th width="1%" class="bg-warning">Tgl</th>
                        <th width="1%" class="bg-warning">Jam</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 0;
                      @endphp
                      @foreach($absensi AS $key => $rows)
                        @php
                       
                        if(date('Y-m-d', strtotime(@$absensi[$key-1]->check_in)) != date('Y-m-d', strtotime($rows->check_in))) {
                           $no = 0;
                        $no++;
                        @endphp
                        <tr>
                          <td colspan="7"></td>
                        </tr>
                        @php
                        }
                        @endphp
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $rows->rfid }}</td>
                          <td>{{ $rows->nama }}</td>
                          <td class="bg-success">{{ date('d F y', strtotime($rows->check_in)) }}</td>
                          <td class="bg-success">{{ date('H:i', strtotime($rows->check_in)) }}</td>
                          <td class="bg-warning">{{ date('d F y', strtotime($rows->check_out)) }}</td>
                          <td class="bg-warning">{{ date('H:i', strtotime($rows->check_out)) }}</td>
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
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
	@endpush

@endsection
