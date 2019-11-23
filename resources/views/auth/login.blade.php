@extends('layouts.header')
@section('custom-css')
    <link rel="stylesheet" href=" {{ asset('css/admin/login.css') }} ">
@endsection
@section('content')
<div class="container" id="main-container">
        <div class="row justify-content-md-center" id="row-login">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="fa fa-user"></span>
                        <h3 class="display-6" id="label-admin-login">Login</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group credentials">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" id="username" placeholder="Username" required autocomplete="username" autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group credentials">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group credentials">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
