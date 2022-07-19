@extends('layouts.admin.master')

@section('title')Data Member
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3><a class="btn btn-xs rounded-0 btn-danger" href="{{ route('member.index') }}">Kembali</a> Data Member</h3>
		@endslot
		<li class="breadcrumb-item">Create Member</li>
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
                  
                    <form class="row g-3 mb-0" id="form" method="POST" action="{{ route('member.store') }}">
                    @csrf
                    <div class="row">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>  
                    @endif
                        <div class="col">
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">RFID</label>
                            <div class="col-sm-9">
                              <input class="form-control @error('rfid') is-invalid @enderror " type="text" id="rfid" name="rfid" value="{{ old('rfid') }}" required/>
                            </div>
                          </div>
                          
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                              <input class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" type="text" id="nama" name="nama" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="alamat" value="{{ old('alamat') }}" name="alamat" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tempat</label>
                            <div class="col-sm-3">
                              <input class="form-control" type="text" id="tempat" value="{{ old('tempat') }}" name="tempat" />
                            </div>
                            <label class="col-sm-1 col-form-label">Tgl Lahir</label>
                            <div class="col-sm">
                              <input class="form-control" type="date" id="tgl_lahir" value="{{ old('tgl_lahir') }}" name="tgl_lahir" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="email" id="email" value="{{ old('email') }}" name="email" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">No HP</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="no_hp" value="{{ old('no_hp') }}" name="no_hp" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">No Identitas</label>
                            <div class="col-sm-2">
                              <select name="jenis_identitasi" class="form-control">
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                                <option value="KTA">KTA</option>
                                <option value="LAINYA">LAINYA...</option>
                              </select>
                            </div>
                            <div class="col-sm">
                              <input class="form-control" type="text" value="{{ old('no_identitas') }}" id="no_identitas" name="no_identitas" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kendaraan</label>
                            <div class="col-sm-9">
                              <select name="kendaraan_id" class="form-control">
                                @foreach($kendaraan as $key => $rows)
                                <option value="{{ $rows->kendaraan_id }}">{{ $rows->nama_kendaraan }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">No Kend / No Pol</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('no_kend') }}" id="no_kend" name="no_kend" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Merk</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="merk" value="{{ old('merk') }}" name="merk" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Warna</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('warna') }}" id="warna" name="warna" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                              <textarea class="form-control" name="keterangan">{!! old('keterangan') !!}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="card-footer">
                  <a href="{{ route('member.index') }}" class="btn btn-sm btn-danger rounded-0">Kembali</a>
                  <button type="submit" form="form" class="btn btn-sm btn-primary rounded-0">Simpan</button>
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
