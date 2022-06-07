@extends('layouts.app')

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
                            <form class="form-horizontal mt-3 form-material" method="POST"
                                action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">
                                        {{ session()->get('applocate') == 'en' ? 'Name' : 'Nombre (s)' }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control rounded @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">
                                        {{ session()->get('applocate') == 'en' ? 'Last name' : 'Apellidos' }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control rounded @error('name') is-invalid @enderror"
                                            name="last_name" value="{{ old('last_name') }}" required
                                            autocomplete="last_name" autofocus>

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        {{ session()->get('applocate') == 'en' ? 'User name' : 'Nombre de usuario' }}</label>

                                    <div class="col-md-6">
                                        <input id="user_name" type="text"
                                            class="form-control rounded @error('user_name') is-invalid @enderror"
                                            name="user_name" value="{{ old('user_name') }}" autocomplete="user_name">

                                        {{-- @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        {{ session()->get('applocate') == 'en' ? 'E-Mail Address' : 'Correo electronico' }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control rounded @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">
                                        {{ session()->get('applocate') == 'en' ? 'Password' : 'Contraseña' }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control rounded @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right">{{ session()->get('applocate') == 'en' ? 'Confirm password' : 'Confirmar contraseña' }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control rounded"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas  fa-user ">
                                                {{ __('Register') }}
                                            </i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
