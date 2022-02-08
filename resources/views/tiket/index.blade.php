@extends('layouts.admin.master')

@section('title')Hapus Tiket
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Hapus Tiket</h3>
		@endslot
		<li class="breadcrumb-item">Hapus Tiket </li>
	@endcomponent
   
    <div class="container-fluid">
        <div class="row">
       
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
            <div class="card">
                	<form class="form theme-form" action="{{ route('tiket.destroy', '1') }}" method="post" autocomplete="off">
                        @csrf
                        @method('delete')
						<div class="card-body">
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="barcode_id">Barcode</label>
										<input class="form-control" id="barcode_id" name="barcode_id" type="text" placeholder="Masukan Kode Barcode" autofocus/>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-end p-3">
							<button class="btn btn-primary" type="submit">Submit</button>
							<input class="btn btn-light" type="reset" value="Cancel" />
						</div>
					</form>
            </div>
          </div>
        </div>
      </div>
	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
	@endpush

@endsection
