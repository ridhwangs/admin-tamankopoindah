@extends('layouts.admin.master')

@section('title')Data Operator
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Create Operator</h3>
		@endslot
		<li class="breadcrumb-item">Operator Parkir (Create)</li>
	@endcomponent
   
    <div class="container-fluid">
        <div class="row">
       
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
      
            @if($errors->any())
                  {!! implode('', $errors->all('
                    <div class="alert alert-danger" role="alert">
                      :message
                    </div>
                  ')) !!}
              @endif
            <div class="card">
              <form action="{{ route('operator.store') }}" class="form theme-form" method="POST">
                @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="username" name="username" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="password" name="password" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama Operator</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" id="nama" name="nama" />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="email" id="email" name="email" />
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
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <div class="col-sm-9 offset-sm-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <input class="btn btn-light" type="reset" value="Cancel" />
                      </div>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script>
    @if($errors->any())
        document.getElementById("username").value = "{{ old('username') }}";
        document.getElementById("password").value = "{{ old('password') }}";
        document.getElementById("nama").value = "{{ old('nama') }}";
        document.getElementById("email").value = "{{ old('email') }}";
        document.getElementById("alamat").value = "{{ old('alamat') }}";
        document.getElementById("no_telp").value = "{{ old('no_telp') }}";
    @endif
    </script>
	@endpush

@endsection
