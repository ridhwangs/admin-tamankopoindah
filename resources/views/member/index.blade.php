@extends('layouts.admin.master')

@section('title')Data Operator
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Member</h3>
		@endslot
		<li class="breadcrumb-item">Member Terdaftar</li>
	@endcomponent
   
    <div class="container-fluid">
        <div class="row">
       
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
            <div class="card">
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                          <th width="1%">No</th>
                          <th>Nama</th>
                          <th>Kendaraan</th>
                          <th>Jenis Member</th>
                          <th width="1%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($member AS $key => $rows)
                        @php
                            $status = [
                                'aktif' => 'success',
                                'pasif' => 'danger',
                                'blokir' => 'dark',
                            ];
                        @endphp
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $rows->nama }}</td>
                          <td>{{ $rows->kendaraan->nama_kendaraan }}</td>
                          <td>{{ $rows->jenis_member }}</td>
                          <td><span class="badge badge-{{ $status[$rows->status] }}">{{ $rows->status }}</span></td>
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