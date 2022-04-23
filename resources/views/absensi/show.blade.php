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
		<li class="breadcrumb-item">Absensi</li>
    <li class="breadcrumb-item">{{ $rfid }}</li>
	@endcomponent
    <div class="container-fluid mb-5">
      @if(!empty(request()->get('berdasarkan')))
         <div class="bookmark mb-3">
          <a href="{{ route('absensi.index') }}" class="btn btn-xs rounded-0 btn-danger">Kembali</a>
          <a href="{{ route('absensi.export', $rfid) }}?berdasarkan={{ request()->get('berdasarkan') }}&tanggal={{ request()->get('tanggal') }}" class="btn btn-xs rounded-0 btn-primary">EXPORT</a>
        </div>
      @endif
      <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
           <div class="card">
              <div class="card-body">
               
                <form class="row g-3 mb-0" id="form">
                    <div class="col-auto">
                      <select id="berdasarkan" name="berdasarkan" class="form-control" required>
                        <option value="" disabled>-- Pilih berdasarkan</option>
                        <option value="bulan_now">Bulan ini</option>
                        <option value="minggu_now">Minggu ini</option>
                        <option value="set_tanggal">Pilih Berdasarkan Tanggal</option>
                      </select>
                    </div>
                    <div class="col-auto">
                        @if(request()->get('berdasarkan') == 'set_tanggal')
                          <label for="tanggal" class="visually-hidden">Tanggal</label>
                          <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>">
                        @endif
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm rounded-0 btn-primary mb-3">Filter</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      @if(!empty(request()->get('berdasarkan')))
      <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
          
      
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
                      $no = 1;
                    @endphp
                    @foreach($absensi AS $key => $rows)
                   
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $rows->rfid }}</td>
                        <td>{{ $rows->nama }}</td>
                        <td class="bg-success">{{ date('d F y', strtotime($rows->check_in)) }}</td>
                        <td class="bg-success">{{ date('H:i', strtotime($rows->check_in)) }}</td>
                        @if(empty($rows->check_out))
                          <td colspan="2" class="bg-danger">-</td>
                        @else
                          <td class="bg-warning">{{ date('d F y', strtotime($rows->check_out)) }}</td>
                          <td class="bg-warning">{{ date('H:i', strtotime($rows->check_out)) }}</td>
                        @endif
                        
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script>
      $("#tanggal").val('{{ !empty(request()->query('tanggal')) ? request()->query('tanggal') : date('Y-m-d') }}');
      $("#berdasarkan").val('{{ request()->query('berdasarkan') }}');
      @if((request()->get('berdasarkan') == 'set_tanggal') && empty(request()->get('tanggal')))
        document.getElementById("form").submit();
      @endif
    </script>
	@endpush

@endsection
