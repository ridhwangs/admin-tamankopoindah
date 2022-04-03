@extends('layouts.admin.master')

@section('title')Parkir Masuk
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Parkir Masuk (DESC)</h3>
		@endslot
	@endcomponent
   
    <div class="container-fluid pt-2 mb-5">
        <div class="row  ">
       <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card o-hidden border-0">
                    <div class="card-header">
                        <div class="header-top">
                            <h6>Filter</h6>
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
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Filter</button>
                                 @if(!empty(request()->query('tanggal'))) 
                                    <a href="{{ route('laporan.export','masuk') }}?tanggal={{ request()->tanggal; }}" class="btn btn-primary mb-3">Export</a>
                                 @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">{{ session()->get('message') }}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
             @if(!empty(request()->query('tanggal')))
            <div class="card p-0">
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                 
                    <table class="table table-sm">
                      <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="1%">Image In</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Status</th>
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
                                      <a class="pop"><img src="http://api.parkir.tamankopoindah.com/api/image/{{ $rows->image_in }}" src="Image not loaded.."  width="100px"></a>
                                  @endif
                                
                              </td>
                              <td>{{ date('d F Y H:i', strtotime($rows->check_in)) }} </td>
                              <td>{{ str_replace('_',' ',$rows->kategori) }}</td>
                              <td>{{ $rows->status }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  
                </div>
              </div>
                <div class="card-footer">
                    {{ $parkir->appends(request()->input())->links(); }}
                <div>
            </div>
            @else
                <p>Silahkan filter terlebih dahulu...</p>
            @endif
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
        $("#tanggal").val('{{ !empty(request()->query('tanggal')) ? request()->query('tanggal') : date('Y-m-d') }}');
        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');   
            });		
        });
    </script>
	@endpush

@endsection
