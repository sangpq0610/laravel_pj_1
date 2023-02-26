@extends('backend.layouts.loginMaster')
@section('title')
Đặt lại mật khẩu
@endsection
@section('login-box-msg')
Đặt lại mật khẩu mới.
@endsection
@section('content')
<form action="{{ route('reset.password') }}" method="post">
    @csrf
    <input type="hidden" name="code" value="{{ $_GET['code'] }}">
    <input type="hidden" name="email" value="{{ $_GET['email'] }}">
    @error('password')
    <div class="col-12">
        <div class="">
            <div class="alert alert-danger col-12">{{ $message }}</div>
        </div>
    </div>
    @enderror
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Mật khẩu mới" name="password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu mới" name="password_confirmation">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
        </div>
      <!-- /.col -->
    </div>
</form>
    <p class="mt-3 mb-1">
    <a href="{{ route('login') }}">Đăng nhập</a>
    </p>
<!-- /.login-card-body -->
</div>
@endsection
