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
       
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
            <div class="card ">
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
        </div>
      </div>
      <hr>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
	@endpush

@endsection
