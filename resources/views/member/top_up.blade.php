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
                        <h6>Filter</h6>
                        <a href="{{ route('member.topup_create') }}" class="btn rounded-0 btn-primary">TOP UP SALDO</a>
                    </div>
                    <div class="setting-list">
                        <ul class="list-unstyled setting-option">
                            <li><i class="icofont icofont-refresh font-primary" onclick="reload_dashboard();"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-t-0 mb-0">
                    <form class="row g-3 mb-0">
                        <div class="col-auto">
                            <label for="tanggal" class="visually-hidden">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Filter</button>
                             
                            <a href="{{ route('member.export','topup') }}?tanggal={{ request()->tanggal; }}" class="btn btn-primary mb-3">Export</a>
                             
                        </div>
                    </form>
                </div>
            </div>
        </div>
          @if($member_transaksi_open->count() > 0)
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5>Need Approval</h5>        
                </div>
                <div class="card-body p-0 height-equal">
                  <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                          <th width="1%">No</th>
                          <th>RFID</th>
                          <th>Jumlah</th>
                          <th>Hari</th>
                          <th width="1%">Status</th>
                          <th>Waktu</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($member_transaksi_open AS $key => $rows)
                        @php
                            $status = [
                                'approve' => 'success',
                                'rejected' => 'danger',
                            ];
                        @endphp
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $rows->rfid }}</td>
                          <td>{{ $rows->jumlah }}</td>
                          <td>{{ $rows->hari }}</td>
                          <td>
                            @if($rows->status == 'open')
                            <form method="POST" action="{{ route('member.update', $rows->topup_id) }}">
                              @method('PUT')
                              @csrf
                              <input type="hidden" value="approve" name="status">
                              <button type="submit" class="btn btn-xs btn-success">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('member.update', $rows->topup_id) }}">
                              @method('PUT')
                              @csrf
                              <input type="hidden" value="rejected" name="status">
                              <button type="submit" class="btn btn-xs btn-danger">Reject</button>
                            </form>
                            @else
                              <span class="badge badge-{{ $status[$rows->status] }}">{{ $rows->status }}</span>
                            @endif
                          </td>
                          <td>{{ $rows->created_at }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
          </div>
          @endif
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
                          <th>RFID</th>
                          <th>Jumlah</th>
                          <th>Hari</th>
                          <th width="1%">Status</th>
                          <th>Waktu</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($member_transaksi AS $key => $rows)
                        @php
                            $status = [
                                'approve' => 'success',
                                'rejected' => 'danger',
                            ];
                        @endphp
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $rows->rfid }}</td>
                          <td>{{ $rows->jumlah }}</td>
                          <td>{{ $rows->hari }}</td>
                          <td>
                            @if($rows->status == 'open')
                            <form method="POST" action="{{ route('member.update', $rows->topup_id) }}">
                              @method('PUT')
                              @csrf
                              <input type="hidden" value="approve" name="status">
                              <button type="submit" class="btn btn-xs btn-success">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('member.update', $rows->topup_id) }}">
                              @method('PUT')
                              @csrf
                              <input type="hidden" value="rejected" name="status">
                              <button type="submit" class="btn btn-xs btn-danger">Reject</button>
                            </form>
                            @else
                              <span class="badge badge-{{ $status[$rows->status] }}">{{ $rows->status }}</span>
                            @endif
                          </td>
                          <td>{{ $rows->created_at }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                    {{ $member_transaksi->appends(request()->input())->links(); }}
              <div>
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
