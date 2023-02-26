@extends('backend.layouts.master')
@section('title')
Danh sách danh mục
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
                        <h1 class="m-0 text-dark">Danh sách liên hệ</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.contact.index') }}">Danh sách liên hệ</a></li>
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
                        <h3 class="card-title">{{ $contact->subject }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td width="200px">Họ và tên</td>
                                <td>{{$contact->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{!!$contact->email!!}
                                </td>
                            </tr>
                            <tr>
                                <td>SĐT</td>
                                <td>{{$contact->phone}}
                                </td>
                            </tr>
                            <tr>
                                <td>Nôi dung</td>
                                <td>{{$contact->content}}
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