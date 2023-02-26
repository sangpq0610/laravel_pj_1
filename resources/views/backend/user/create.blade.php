@extends('backend.layouts.master')
@section('title')
Tạo mới người dùng
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
                <h1 class="m-0 text-dark">Tạo người dùng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">Người dùng</a></li>
                    <li class="breadcrumb-item active">Tạo mới</li>
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
                        <h3 class="card-title">Tạo mới người dùng</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('backend.user.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                <input type="text" class="form-control" id="" placeholder="Tên người dùng" name="name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                <input type="email" class="form-control" id="" placeholder="Email" name="email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @if ( Session::has('flash_error') )
                                <div class="alert alert-danger">{{ Session::get('flash_error') }}</div>
                                @endif
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Mật khẩu <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                    <input type="password" class="form-control" id="" name="password">
                                </div>
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Xác nhận mật khẩu <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
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
                                <label for="exampleInputEmail1">Địa chỉ <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                <input type="text" class="form-control" id="" name="address">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                <input type="text" class="form-control" id="" name="phone">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control select2" style="width: 100%;" name="role">
                                    <option value="0">Người dùng</option>
                                    <option value="1">Quản lý</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a class="btn btn-default" href="{{route('backend.user.index')}}">Huỷ bỏ</a>
                            <button type="submit" class="btn btn-success">Tạo mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
        </section>
@endsection