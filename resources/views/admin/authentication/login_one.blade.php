@extends('admin.authentication.master')

@section('title')
	Auth > Login
@endsection

@push('css')
@endpush

@section('content')
    <section>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/2.jpg') }}" alt="looginpage" /></div>
	            <div class="col-xl-5 p-0">
					
	                <div class="login-card">
						
	                    <form class="theme-form login-form" method="POST" action="{{ route('doLogin'); }}">
								@error('message')
							<div class="alert alert-dark inverse alert-dismissible fade show" role="alert"><i class="icon-info-alt"></i>
								<p> {{ $message }}</p>
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
							</div>
							@enderror
						@csrf
	                        <h4>Login</h4>
	                        <h6>Welcome back! Log in to your account.</h6>
						
	                        <div class="form-group">
	                            <label>Email Address</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-email"></i></span>
	                                <input class="form-control" name="email" type="email" required="" placeholder="Masukan email anda" />
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label>Password</label>
	                            <div class="input-group">
	                                <span class="input-group-text"><i class="icon-lock"></i></span>
	                                <input class="form-control" type="password" name="password" required="" placeholder="*********" />
	                                <div class="show-hide"><span class="show"> </span></div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="checkbox">
	                                <input id="checkbox1" type="checkbox" />
	                                <label class="text-muted" for="checkbox1">Remember password</label>
	                            </div>
	                            <a class="link" href="{{ route('forget-password') }}">Forgot password?</a>
	                        </div>
	                        <div class="form-group">
	                            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	
    @push('scripts')
    @endpush

@endsection