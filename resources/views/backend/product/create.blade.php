@extends('backend.layouts.master')
@section('title')
Danh sách sản phẩm
@endsection
@section('css')

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                }
            
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#upload').on('change', function() {
            readURL(this);
        });
    });
</script>
@endsection
@section('content-header')
<div class="content-header">
    <!-- Content Header -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tạo sản phẩm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.product.index') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Tạo sản phẩm</li>
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
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('backend.product.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                <input type="text" class="form-control" id="" placeholder="Điền tên sản phẩm " name="name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm</label>
                                <select class="form-control select2" style="width: 100%;" name="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Giá gốc <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                        <input type="text" class="form-control" placeholder="Điền giá gốc" name="origin_price">
                                        @error('origin_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Giá khuyến mại</label>
                                        <input type="text" class="form-control" placeholder="Điền giá khuyến mại" name="sale_price">
                                        @error('sale_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả sản phẩm <span style="color: red" data-toggle="tooltip" title="Bắt buộc điền">*</span></label>
                                <textarea class="textarea" placeholder="Điền mô tả sản phẩm"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="content"></textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hình ảnh sản phẩm <span style="color: red" data-toggle="tooltip" title="Bắt buộc thêm">*</span></label>
                                <div class="input-group">
                                    <img src="/storage/images/no-image.jpg" id="img" style="max-width: 100px">
                                </div>
                                <div class="input-group">                                    
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="upload" name="images">
                                        <label class="custom-file-label" for="upload">Thêm ảnh</label>
                                    </div>
                                </div>
                                @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @if ( Session::has('images') )
                                <div class="alert alert-danger">{{ Session::get('images') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Điền đường dẫn sản phẩm" name="slug">
                                @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Số lượng trong kho</label>
                                <input type="text" class="form-control" placeholder="Điền số sản phẩm trong kho" name="amount">
                                @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-default">Huỷ bỏ</button>
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