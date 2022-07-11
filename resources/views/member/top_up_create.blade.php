@extends('layouts.admin.master')

@section('title')Data Operator
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>TOP UP Member</h3>
		@endslot
		<li class="breadcrumb-item">Member Transaksi</li>
	@endcomponent
   
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card o-hidden border-0">
                <div class="card-header">
                  
                    <div class="setting-list">
                        <ul class="list-unstyled setting-option">
                            <li><i class="icofont icofont-refresh font-primary" onclick="reload_dashboard();"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-t-0 mb-0">
                    <form class="row g-3 mb-0" method="POST" action="" id="form-submit">
                    <div class="row">
                        <div class="col">
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RFID</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="rfid" name="rfid" required/>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Jumlah Rupiah</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="jumlah" name="jumlah" required/>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Lama Hari</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="number" id="hari" name="hari" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary" form="form-submit">Submit</button>
                </div>
            </div>
        </div>
        </div>
      </div>
      <hr>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>

	@endpush

@endsection
