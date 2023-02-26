@extends('backend.layouts.master')
@section('title')
Thay đổi thông tin cá nhân
@endsection
@section('css')
    
@endsection
@section('js')

@endsection
@section('content-header')
        <div class="content-header">
            <!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Thay đổi thông tin cá nhân</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">Người dùng</a></li>
                    <li class="breadcrumb-item active">Cập nhật</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
        </div>
@endsection
@section('main-content')
        <section class="content">
            <!-- Content -->
<div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cập nhật thông tin</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('backend.user.update',$user->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input type="text" class="form-control" id="" placeholder="Tên người dùng" name="name" value="{{ Auth::user()->name }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="" placeholder="Email" name="email" value="{{ Auth::user()->email }}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @if ( Session::has('flash_error') )
                                <div class="alert alert-danger">{{ Session::get('flash_error') }}</div>
                                @endif
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="" name="password">
                                </div>
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Xác nhận mật khẩu mới</label>
                                    <input type="password" class="form-control" id="" name="password_confirmation">
                                </div>
                                @error('password')
                                <div class="col-12">
                                    <div class="">
                                        <div class="alert alert-danger col-12">{{ $message }}</div>
                                    </div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input type="text" class="form-control" id="" name="address" value="{{ Auth::user()->address }}">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" class="form-control" id="" name="phone" value="{{ Auth::user()->phone }}">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a class="btn btn-default" href="{{route('backend.user.index')}}">Huỷ bỏ</a>
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
        </section>
@endsection