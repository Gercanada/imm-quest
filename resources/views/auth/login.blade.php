@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <div class="container-fluid"
        style="background:url(/{{ env('ASSET_URL') }}images/fondocanada.jpg) no-repeat center center; background-size: cover;">
        <div class=" auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box p-4 bg-white rounded">
                <div id="loginform" style="opacity:85%; position:relative;">
                    <div class="mb-4  text-center mb-4 pb-4 ">
                        <img src="/{{ env('ASSET_URL') }}images\cropped_ger_logo.png" width="40px" sizes="40x40"
                            alt="homepage" class="dark-logo" />
                        <img src="/{{ env('ASSET_URL') }}images\ger_logo.png" sizes="160x34" alt="homepage"
                            width="160px" />
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3 form-material" id="loginform" method="POST"
                                action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="">
                                        <input id="user_name" type="text" placeholder="Username" style="opacity:75%;"
                                            class="form-control rounded
                                    @error('user_name') is-invalid @enderror"
                                            name="user_name" value="{{ old('user_name') }}" required autocomplete="text"
                                            autofocus>

                                        @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    {{-- <password-input /> --}}
                                    <div class="input-group" id="show_hide_password">
                                        <input id="password" style="opacity:75%;" type="password"
                                            class="form-control rounded @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">
                                        {{-- <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div> --}}
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="checkbox checkbox-info pt-0">
                                            <input class="material-inputs chk-col-indigot" id="checkbox-signup"
                                                type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="checkbox-signup"> Remember me </label>
                                        </div>
                                        {{-- <div class="ml-auto">
                                            @if (Route::has('password.request'))
                                                <a id="to-recover" class="text-muted float-right"
                                                    href="{{ route('password.request') }}">
                                                    <i class="fa fa-lock mr-1"></i>
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group text-center mt-4"
                                    style="position:relative;
                                                                                                                                                                                                            z-index:1;">
                                    <div class="col-xs-12">
                                        <button
                                            class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                            type="submit"><i class="fas  fa-key "> </i> Log In</button>
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
                                    <button class="btn btn-block btn-lg btn-primary text-uppercase" type="submit"
                                        name="action">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script>
        let event = document.querySelector(".reveal").addEventListener('click', function() {
            var $pwd = document.querySelector(".pwd");
            //    $pwd;
            console.log($pwd);


            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });

        let newVal = JSON.parse(
            JSON.stringify(event.target)
        )._value;

        console.log(newVal);
    </script> --}}
@endsection
