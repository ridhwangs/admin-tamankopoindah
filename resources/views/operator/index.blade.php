@extends('layouts.admin.master')

@section('title')Data Operator
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Operator</h3>
		@endslot
		<li class="breadcrumb-item">Operator Parkir (Login)</li>
	@endcomponent
   
    <div class="container-fluid">
        <div class="row">
       
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            @if(session()->has('message'))
              <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="bookmark mb-3">
              <a href="{{ route('operator.create') }}" class="btn btn-xs rounded-0 btn-primary"><i class="icofont icofont-plus"></i> Tambah Operator</a>
            </div>
            <div class="card">
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username (login)</th>
                        <th>Passowrd</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Last Login</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($operator AS $key => $rows)
                      @php
                        $status = [
                            '1' => 'aktif',
                            '0' => 'pasif'
                          ];
                      @endphp
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $rows->nama }}</td>
                          <td>{{ $rows->username }}</td>
                          <td>{{ $rows->password }}</td>
                          <td>{{ $rows->email }}</td>
                          <td>{{ $rows->level }}</td>
                          <td>{{ $status[$rows->status] }}</td>
                          <td>{{ $rows->last_login->created_at }}</td>
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
