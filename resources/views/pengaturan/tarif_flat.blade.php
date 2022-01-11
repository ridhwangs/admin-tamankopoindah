@extends('layouts.admin.master')

@section('title')Pengaturan Tarif Flat
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pengaturan </h3>
		@endslot
		<li class="breadcrumb-item">Tarif Flat</li>
	@endcomponent

    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            <div class="card">
              
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Kendaraan</th>
                        <th>Tarif</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form>
                        @php
                          $last_update = "";
                          $user_by = "";
                        @endphp
                        @foreach($tarif_flat AS $key => $rows)
                        @php
                          $last_update = $rows->updated_at;
                          $user_by = $rows->created_by;
                        @endphp
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $rows->kendaraan->kategori }}</td>
                            <td>{{ $rows->kendaraan->nama_kendaraan }}</td>
                            <td><input type="text" class="form-control form-control-sm text-end" name="tarif[{{ $key }}]" value="{{ $rows->tarif }}"></td>
                          </tr>
                        @endforeach
                      </form>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer p-2">
                <span class="text-xs">Last Update : {{ $last_update; }} by {{ $user_by }}</span>
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
