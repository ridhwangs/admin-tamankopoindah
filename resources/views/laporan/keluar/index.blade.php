@extends('layouts.admin.master')

@section('title')Data Operator
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Parkir Keluar (DESC)</h3>
		@endslot
		<li class="breadcrumb-item">Laporan Parkir Keluar</li>
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
              <div class="card-header">
                  <form class="row g-3 mb-0">
                      <div class="col-auto">
                          <label for="tanggal" class="visually-hidden">Tanggal</label>
                          <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>">
                      </div>
                      <div class="col-auto">
                          <label for="operator_id" class="visually-hidden">Operator</label>
                          <select class="form-control" name="operator_id" id="operator_id">
                              <option value="">Tampilkan Semua</option>
                              @foreach($filter_operator_dashboard AS $key => $rows)
                                  <option value="{{ $rows->operator_id }}">{{ $rows->operator->nama }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-auto">
                          <label for="operator_id" class="visually-hidden">Shift</label>
                          <select class="form-control" name="shift_id" id="shift_id">
                              <option value="">Semua Shift</option>
                              @foreach($filter_shift_dashboard AS $key => $rows)
                                  <option value="{{ $rows->shift_id }}">{{ $rows->shift->nama_shift }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-auto">
                          <button type="submit" class="btn btn-primary mb-3">Filter</button>
                      </div>
                  </form>
              </div>
              <div class="card-body p-0 height-equal">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                          <th width="1%">No</th>
                          <th width="1%">Image In</th>
                          <th>Waktu Masuk</th>
                          <th>Waktu Keluar</th>
                          <th>Kategori</th>
                          <th>Kendaraan</th>
                          <th>Tarif</th>
                          <th>Keterangan</th>
                          <th>Operator</th>
                          <th>Shift</th>
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
                                    <a class="pop"><img src="//api.parkir.spsarana.com/api/image/{{ $rows->image_in }}" src="Image not loaded.."  width="100px"></a>
                                @endif
                               
                            </td>
                            <td>{{ $rows->check_in }}</td>
                            <td>{{ $rows->check_out }}</td>
                            <td>{{ str_replace('_',' ',$rows->kategori) }}</td>
                            <td>{{ $rows->kendaraan->nama_kendaraan }}</td>
                            <td>{{ $rows->tarif }}</td>
                            <td>{{ $rows->keterangan }}</td>
                            <td>{{ $rows->operator->nama }}</td>
                            <td>{{ $rows->shift->nama_shift }}</td>
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
        $("#tanggal").val('{{ !empty(request()->query('tanggal')) ? request()->query('tanggal') : date('Y-m-d') }}');
        $("#operator_id").val('{{ request()->query('operator_id') }}');
        $("#shift_id").val('{{ request()->query('shift_id') }}');
    </script>
	@endpush

@endsection
