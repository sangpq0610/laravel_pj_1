@extends('backend.layouts.master')
@section('title')
Tạo mới danh mục
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
                <h1 class="m-0 text-dark">Cập Nhật Danh Mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">Danh Mục</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('backend.category.show', $category->id) }}">{{ $category->name }}</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('main-content')
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cập nhật danh mục {{ $category->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('backend.category.update', $category->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="" placeholder="Điền tên danh mục " name="name" value="{{ $category->name }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if($category->parent_id!=null)
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select class="form-control select2" style="width: 100%;" name="parent_id">
                                    <option value="">{{'--<Chọn danh mục cha>--'}}</option>
                                    @foreach ($categories as $value)
                                    <option value="{{ $value->id }}" @if($value->id==$category->parent_id) selected @endif>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputFile">Hình ảnh danh mục</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                                @if ( Session::has('images') )
                                <div class="alert alert-danger">{{ Session::get('images') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đường dẫn danh mục</label>
                                <input type="text" class="form-control" id="" placeholder="Điền tên danh mục " name="slug" value="{{ $category->slug }}">
                                @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a class="btn btn-default" href="{{ route('backend.category.index') }}">Huỷ bỏ</a>
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