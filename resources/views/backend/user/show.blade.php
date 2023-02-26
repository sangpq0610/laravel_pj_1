@extends('backend.layouts.master')
@section('title')
người dùng
@endsection
@section('css')
    
@endsection
@section('js')

@endsection
@section('content-header')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">người dùng {{ $user->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('backend.user.index') }}">Danh sách người dùng</a></li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
@endsection
@section('main-content')
        <section class="content">
            <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Người dùng {{ $user->name }}</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <a href="{{ route('backend.user.showProducts',$user->id)}}" class="btn btn-success">Sản phẩm</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>Họ Tên</td>
                                <td>{{$user->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{!!$user->email!!}
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>{{$user->address}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
@endsection