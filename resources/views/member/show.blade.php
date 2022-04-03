@extends('layouts.admin.master')

@section('title')Data Operator
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data RFID: {{ $member->rfid }}</h3>
		@endslot
		<li class="breadcrumb-item">Member Details</li>
	@endcomponent
      <div class="container-fluid mb-5">
        <div class="row">   
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            <div class="card">
               <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                          <th>RFID</th>
                          <th>Nama</th>
                          <th>Kendaraan</th>
                          <th>Jenis Member</th>
                          <th width="1%">Status</th>
                          <th width="1%"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $status = [
                                'aktif' => 'success',
                                'pasif' => 'danger',
                                'blokir' => 'dark',
                            ];
                        @endphp
                        <tr>
                          <td> {{ $member->rfid }}</td>
                          <td>{{ $member->nama }}</td>
                          <td>{{ $member->kendaraan->nama_kendaraan }}</td>
                          <td>{{ $member->jenis_member }}</td>
                          <td><span class="badge badge-{{ $status[$member->status] }}">{{ $member->status }}</span></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
            <div class="card">
              <div class="card-header p-3">
                <h5>Member Top Up</h5>
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
            </div>
          </div>
          <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
            <div class="card">
              <div class="card-header p-3">
                <h5>Member Usesage (DESC)</h5>
              </div>
               <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                    <table class="table table-sm">
                    <thead>
                      <tr>
                          <th>Waktu Masuk</th>
                          <th>Waktu Keluar</th>
                          <th width="1%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($member_usesage AS $key => $rows)
                        <tr>
                          <td>{{ date('d F Y H:i', strtotime($rows->check_in)) }} </td>
                          <td>{{ date('d F Y H:i', strtotime($rows->check_out)) }} </td>
                          <td>{{ $rows->status }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                    {{ $member_usesage->appends(request()->input())->links(); }}
              <div>
            </div>
          </div>
        </div>
      </div>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
	@endpush

@endsection
