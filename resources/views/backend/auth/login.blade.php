@extends('backend.layouts.loginMaster')
@section('title')
Đăng nhập
@endsection
@section('login-box-msg')
Đăng nhập
@endsection
@section('content')
<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
            </div>
        </div>
        <!-- /.col -->
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
        </div>
        <!-- /.col -->
    </div>
</form>
@endsection
@section('or')
<p class="mb-1">
    <a href="{{ route('password.request') }}">Quên mật khẩu</a>
</p>
<p class="mb-0">
    <a href="{{ route('register') }}" class="text-center">Đăng ký</a>
</p>
@endsection