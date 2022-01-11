@extends('layouts.admin.master')

@section('title')Pengaturan Tarif Progressive
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pengaturan Progressive</h3>
		@endslot
		<li class="breadcrumb-item">Tarif Progressive </li>
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
            <button type="submit" form="form-batch" class="btn btn-xs rounded-0 btn-primary"><i class="icofont icofont-save"></i> Simpan semua Perubahan</button>
          </div>
            <div class="card">
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Kendaraan</th>
                        <th>Tarif-1</th>
                        <th>Tarif-2</th>
                        <th>Tarif-3</th>
                        <th>Tarif-4</th>
                        <th>Tarif-5</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form id="form-batch" method="POST" action="{{ route('tarif-progressive.update', $api_key) }}">
                        @method('PUT')
                        @csrf

                        @php
                          $last_update = "";
                          $user_by = "";
                        @endphp
                        @foreach($tarif_progressive AS $key => $rows)
                        @php
                          $last_update = $rows->updated_at;
                          $user_by = $rows->created_by;
                        @endphp
                          <tr>
                            <td><input type="hidden" name="id[{{ $key }}]" value="{{ $rows->id }}">{{ $key+1 }}</td>
                            <td>{{ $rows->kendaraan->kategori }}</td>
                            <td>{{ $rows->kendaraan->nama_kendaraan }}</td>
                            <td>
                              <input type="text" class="form-control form-control-sm text-end" name="tarif_1[{{ $key }}]" value="{{ $rows->tarif_1 }}">
                            </td>
                            <td>
                              <input type="text" class="form-control form-control-sm text-end" name="tarif_2[{{ $key }}]" value="{{ $rows->tarif_2 }}">
                            </td>
                            <td>
                              <input type="text" class="form-control form-control-sm text-end" name="tarif_3[{{ $key }}]" value="{{ $rows->tarif_3 }}">
                            </td>
                            <td>
                              <input type="text" class="form-control form-control-sm text-end" name="tarif_4[{{ $key }}]" value="{{ $rows->tarif_4 }}">
                            </td>
                            <td>
                              <input type="text" class="form-control form-control-sm text-end" name="tarif_5[{{ $key }}]" value="{{ $rows->tarif_5 }}">
                            </td>
                          </tr>
                        @endforeach
                      </form>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer p-2">
                <label class="text-xs">Last Update : <code>{{ $last_update; }}</code> by <code>{{ $user_by }}</code></label>
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
