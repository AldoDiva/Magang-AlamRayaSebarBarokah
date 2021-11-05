@extends('auth.ekstensi')


<body>
    <br><br>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>
     
            <div class="card">
                

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <div class="">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password??') }}
                                </a>
</div>
                                @endif
                                <div>
                            <a class="btn btn-link" href="{{ route('register') }}">You Don't Have an Account??</a>
                        </div>

                                
                            
</div>
                            </div>
                            

                    </form>

                    <hr>
                    <div class="row">
                        <div class="col-md-10 ">
                            <a class="btn btn-primary btn-sm" type="button" href="{{ url('/login/google') }}" title="Login menggunakan GMail"><i class="fa fa-envelope"></i></a>
                            <a class="btn btn-primary btn-sm" type="button" href="{{ url('/login/github') }}" title="Login menggunakan Github"><i class="fab fa-github"></i></a>
                            <a class="btn btn-primary btn-sm" type="button" href="{{ url('/login/facebook') }}" title="Login menggunakan Facebook"><i class="fab fa-facebook"></i></a>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</body>

