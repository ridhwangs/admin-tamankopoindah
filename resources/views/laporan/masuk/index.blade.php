@extends('layouts.admin.master')

@section('title')Data Operator
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Parkir Masuk (DESC)</h3>
		@endslot
		<li class="breadcrumb-item">Waktu berjalan {{ date('d F Y') }}</li>
	@endcomponent
   
    <div class="container-fluid pt-2 mb-5">
        <div class="row  ">
       
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
            <div class="card p-0">
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                          <th width="1%">No</th>
                          <th width="1%">Image In</th>
                          <th>Waktu Masuk</th>
                          <th>Kategori</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($parkir AS $key => $rows)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if($rows->kategori == 'member')
                                    <small>Not Included</small>
                                @else
                                    <a class="pop"><img src="http://api.parkir.spsarana.com/api/image/{{ $rows->image_in }}" src="Image not loaded.."  width="100px"></a>
                                @endif
                               
                            </td>
                            <td>{{ $rows->check_in }}</td>
                            <td>{{ str_replace('_',' ',$rows->kategori) }}</td>
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

    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">              
                <div class="modal-body">
                    <img src="" class="imagepreview" style="width: 100%;" >
                </div>
            </div>
        </div>
    </div>

	@push('scripts')
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script>
        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');   
            });		
        });
    </script>
	@endpush

@endsection
