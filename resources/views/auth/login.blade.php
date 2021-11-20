@extends('layouts.app')

@section('content')
 <!-- ============================================================== -->
 <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/background/login-register.jpg) no-repeat center center; background-size: cover;">
    <div class="auth-box p-4 bg-white rounded">
        <div id="loginform">
            <div class="logo">
                <h3 class="box-title mb-3">Sign In</h3>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal mt-3 form-material" id="loginform" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="">
                                {{-- <input class="form-control" type="text" required="" placeholder="Username">  --}}
                                <input id="email" type="email"  placeholder="Username" class="form-control
                                @error('email') is-invalid
                                @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid
                                @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               {{--  <input class="form-control" type="password" required="" placeholder="Password"> --}} </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="checkbox checkbox-info pt-0">
                                   {{--  <input id="checkbox-signup" type="checkbox" class="material-inputs chk-col-indigo"> --}}
                                   <input class="material-inputs chk-col-indigot"  id="checkbox-signup" type="checkbox" name="remember"  {{ old('remember') ? 'checked' : '' }}>
                                    <label for="checkbox-signup"> Remember me </label>
                                </div>
                                <div class="ml-auto">
                                  {{--   <a href="javascript:void(0)" id="to-recover" class="text-muted float-right"><i class="fa fa-lock mr-1"></i> Forgot pwd?</a> --}}
                                  @if (Route::has('password.request'))
                                    <a id="to-recover" class="text-muted float-right" href="{{ route('password.request') }}">
                                        <i class="fa fa-lock mr-1"></i>
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center mt-4">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                                <div class="social mb-3">
                                    <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </a>
                                    <a href="{{route('login.google')}}" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google"></i> </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-4">
                            <div class="col-sm-12 justify-content-center d-flex">
                                <p>Don't have an account? <a href="authentication-register1.html" class="text-info font-weight-normal ml-1">Sign Up</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="recoverform">
            <div class="logo">
                <h3 class="font-weight-medium mb-3">Recover Password</h3>
                <span class="text-muted">Enter your Email and instructions will be sent to you!</span>
            </div>
            <div class="row mt-3 form-material">
                <!-- Form -->
                <form class="col-12" action="index.html">
                    <!-- email -->
                    <div class="form-group row">
                        <div class="col-12">
                            <input class="form-control" type="email" required="" placeholder="Username">
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <button class="btn btn-block btn-lg btn-primary text-uppercase" type="submit" name="action">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
