@extends('layouts.admin.master')

@section('title')Absensi 
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Absensi</h3>
		@endslot
		<li class="breadcrumb-item">Absen Mingguan</li>
	@endcomponent
   
    <div class="container-fluid mb-5">
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
                          <th width="1%" rowspan="2">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($absensi AS $key => $rows)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $rows->rfid }}</td>
                          <td>{{ $rows->nama }}</td>
                          <td><a href="{{ route('absensi.show', $rows->rfid) }}">Show</a></td>
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
