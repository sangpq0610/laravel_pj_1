@extends('backend.layouts.loginMaster')
@section('title')
Quên mật khẩu
@endsection
@section('login-box-msg')
Quên mật khẩu? Bạn có thể dễ dàng lấy lại mật khẩu ở đây.
@endsection
@section('content')
<form action="{{ route('send.reset.password.mail') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Yêu cầu mật khẩu mới</button>
        </div>
      <!-- /.col -->
    </div>
</form>
@endsection
@section('or')
<p class="mb-1">
    <a href="{{ route('login') }}">Đăng nhập</a>
</p>
<p class="mb-0">
    <a href="{{ route('register') }}" class="text-center">Đăng ký</a>
</p>
@endsection
@section('js')
    {{-- @if(isset($success))
    <script type="text/javascript">
        swal("Thành công!", "{{ $success }}", "success");
    </script>
    @endif
    @if(isset($danger))
    <script type="text/javascript">
        swal("Thất bại!", "{{ $danger }}", "error");
    </script>
    @endif --}}
@endsection