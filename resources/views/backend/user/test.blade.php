@extends('backend.layouts.master')
@section('title')
Tinh ma tran
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
                    <form role="form" action="{{ route('backend.user.test1') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <label>Art<span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                            <div class="row form-group">
                                @for($j = 1; $j<=4; $j++)
                                <div class="col-3">
                                    <input type="number" class="form-control" name="art<?=$j?>">
                                </div>
                                @endfor
                            </div>
                            @for($i = 1; $i<=6; $i++)
                            <label>Food<?= $i ?> <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                            <div class="row form-group">
                                @for($j = 1; $j<=4; $j++)
                                <div class="col-3">
                                    <input type="number" class="form-control" name="food<?= $i.$j ?>">
                                </div>
                                @endfor
                            </div>
                            @endfor
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a class="btn btn-default" href="{{route('backend.user.index')}}">Huỷ bỏ</a>
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
        </section>
@endsection