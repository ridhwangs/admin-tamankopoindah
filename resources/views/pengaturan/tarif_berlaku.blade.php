@extends('layouts.admin.master')

@section('title')Pengaturan Tarif Berlaku
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pengaturan</h3>
		@endslot
		<li class="breadcrumb-item">Tarif Berlaku</li>
    <li class="breadcrumb-item">API-KEY {{ $tarif_setting->api_key }}</li>
	@endcomponent

    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-xl-6 col-lg-12 col-md-6">
            <div class="card">
              <div class="card-body row switch-showcase height-equal">
                <div class="col-sm-12">
                  <div class="media">
                    <label class="col-form-label m-r-10">Berlakukan tarif Flat</label>
                    <div class="media-body text-end icon-state">
                      <label class="switch">
                        <input type="checkbox" class="checkbox" name="flat" id="flat" onclick="toggleSwitch(this.id)"><span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                  <div class="media">
                    <label class="col-form-label m-r-10">Berlakukan tarif Progressive</label>
                    <div class="media-body text-end icon-state">
                      <label class="switch">
                        <input type="checkbox" class="checkbox" name="progressive" id="progressive" onclick="toggleSwitch(this.id)"><span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer p-2">
                <label id="info-update">Last Update : <code>{{ $tarif_setting->updated_at; }}</code> by <code>{{ $tarif_setting->created_by }}</code></label>
              </div>
            </div>
          </div>
        </div>
      </div>
	@push('scripts')
  
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>

    <script>
      
       $(document).ready(function() {
            @if($tarif_setting->tarif_berlaku == 'flat')
              $('#flat').prop('checked', true);
            @elseif($tarif_setting->tarif_berlaku == 'progressive')
              $('#progressive').prop('checked', true);
            @endif
       });
                
            function toggleSwitch(tarif) {
              var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
              $('.checkbox').prop('checked', false);
              document.getElementById(tarif).checked = true;
              
              $.ajax({
                  url: '{{ route('tarif-berlaku.update', $tarif_setting->api_key) }}',
                  type: 'PUT',
                  cache: false,
                  data: {_token : CSRF_TOKEN, tarif_berlaku:tarif},
              })
              .done(function(data) {
                  console.log(data.message);
                  swal("", data.message, data.type);
                  $('#info-update').load(location.href+(' #info-update'));
              })
              .fail(function() {
                  console.log("error");
              })
            }
  
   
    </script>
	@endpush

@endsection
