@extends('layouts.admin.master')

@section('title')Top Up {{ $data->rfid }}
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3><a class="btn btn-xs rounded-0 btn-danger" href="{{ URL::previous(); }}">Kembali</a> TOP UP Member</h3>
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
                    <form class="row g-3 mb-0" method="POST" action="{{ route('member.store_top_up') }}" id="form-submit">
                    @csrf
                    <div class="row">
                        <div class="col">
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RFID</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="rfid" name="rfid" readonly value="{{ $data->rfid; }}"/>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="nama" name="nama" readonly value="{{ $data->nama; }}"/>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Regis/Exp</label>
                            <div class="col-sm">
                              <input class="form-control" type="date" id="tgl_awal" name="tgl_awal" readonly value="{{ $data->tgl_awal; }}"/>
                            </div>
                            <div class="col-sm">
                              <input class="form-control" type="date" id="tgl_akhir" name="tgl_akhir" readonly value="{{ date('Y-m-d', strtotime($data->tgl_awal . " +$sum_hari_topup days")); }}"/>
                            </div>
                            <div class="col-sm-2">
                              <input class="form-control" type="text" id="sum_hari" name="sum_hari" readonly value="Total {{ $sum_hari_topup; }} Hari"/>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Jumlah Rupiah</label>
                            <div class="col-sm-9">
                              <input class="form-control rupiah" type="number" id="jumlah" name="jumlah" required autofocus/>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Lama Hari</label>
                            <div class="col-sm-3">
                              <input class="form-control" type="number" id="hari" name="hari" required/>
                            </div>
                            <div class="col-sm">
                              <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tombol Bantuan hitung hari</a>
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
      <!-- Modal -->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Bantuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Expire Kartu</label>
              <input type="date" class="form-control" id="tgl_expired" aria-describedby="tgl_expire">
              <div id="tgl_expire" class="form-text">Secara otomatis menghitung lama hari</div>
            </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="kalkulasi();" class="btn btn-primary">Kalkulasi</button>
      </div>
    </div>
  </div>
</div>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script>
      function kalkulasi() {
            var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date($("#tgl_akhir").val());
            var secondDate = new Date($("#tgl_expired").val());
            var diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));
            $("#hari").val(diffDays);
            $("#staticBackdrop .btn-close").click()
      }
    </script>
	@endpush

@endsection
