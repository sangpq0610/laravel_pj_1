@extends('backend.layouts.master')
@section('title')
Danh sách sản phẩm
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
                        <h1 class="m-0 text-dark">Danh sách sản phẩm</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">Danh mục</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.category.show', $category->id) }}">{{ $category->name }}</a></li>
                            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
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
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Đã bán</th>
                                <th>Mô tả</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->name}}</td>
                                <td><img src="{{ $images[$product->id]->path }}" alt=" " class="img-responsive" style="max-height: 140px; max-width: 140px;" /></td>
                                <td>{{$product->sold}}</td>
                                <td>{{$product->content}}</td>
                            </tr>
                            @endforeach
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