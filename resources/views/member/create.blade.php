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
		<li class="breadcrumb-item">Member Transaksi</li>
	@endcomponent
   
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card o-hidden border-0">
                <div class="card-header">
                    <div class="header-top">
                        <h6>Create</h6>
                    </div>
                    <div class="setting-list">
                        <ul class="list-unstyled setting-option">
                            <li><i class="icofont icofont-refresh font-primary" onclick="reload_dashboard();"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-t-0 mb-0">
                    <form class="row g-3 mb-0" method="POST" action="">
                    <div class="row">
                        <div class="col">
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RFID</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="rfid" name="rfid" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="nama" name="nama" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="alamat" name="alamat" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tempat</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="tempat" name="tempat" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="alamat" name="alamat" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="no_telp" name="no_telp" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kendaraan</label>
                            <div class="col-sm-9">
                              <select name="kendaraan_id">
                                @foreach($kendaraan as $key => $rows)
                                <option value="{{ $rows->kendaraan_id }}">{{ $rows->nama_kendaraan }}</option>
                                @endforeach
                              
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
      </div>
      <hr>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script>
       $("#tanggal").val('{{ request()->query('tanggal') }}');
    </script>
	@endpush

@endsection
