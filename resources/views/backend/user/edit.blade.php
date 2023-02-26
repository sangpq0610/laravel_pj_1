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
                <h1 class="m-0 text-dark">Sửa quyền người dùng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">Người dùng</a></li>
                    <li class="breadcrumb-item active">Sửa quyền</li>
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
                        <h3 class="card-title">{{ $user->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('backend.user.update',$user->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control select2" style="width: 100%;" name="role">
                                    <option value="1" @if($user->role==1) selected @endif>Admin</option>
                                    <option value="0" @if($user->role==0) selected @endif>User</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a class="btn btn-default" href="{{route('backend.user.index')}}">Quay lại</a>
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