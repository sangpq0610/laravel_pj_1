@extends('backend.layouts.master')
@section('title')
Danh sách sản phẩm
@endsection
@section('css')
    
@endsection
@section('js')
<script type="text/javascript">
    function deleteProduct(id){
        swal({
          title: "Bạn có chắc muốn xóa sản phẩm này không?",
          text: "Hành động không thể hoàn tác",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "/admin/product/delete/"+id,
                    data : {'_method' : 'DELETE', '_token' : '{{ csrf_token() }}'},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        swal({
                            title : "Xóa thành công",
                            icon : "success",
                            button : "Done",
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(data) {
                        swal({
                            title : "Xóa thất bại",
                            icon : "warning",
                        });
                    }
                });
            } else {
                swal("Hủy thành công!");
            }
        });
    }
</script>
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
                @if ( Session::has('msg') )
                <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('backend.product.create') }}" class="btn btn-primary">Tạo mới</a> 
                        {{-- <form action="" style="float: right">
                            <select name = "day_created">
                                <option value="true">cũ nhất</option>
                                <option value="fail">mới nhất</option>
                            </select>
                            <select name = "hot">
                                <option value="true">bán chạy nhất</option>
                                <option value="fail">bán ít nhất</option>
                            </select>
                            <select name = "storage">
                                <option value="true">còn trong kho nhiều nhất</option>
                                <option value="fail">cháy hàng</option>
                            </select>
                        </form> --}}
                        <div class="card-tools">
                            <form action="" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="key" class="form-control float-right" placeholder="Tìm kiếm">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Đã bán</th>    
                                <th>Danh mục</th>    
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><a href="{{ route('backend.product.show',$product->id) }}">{{$product->name}}</a></td>
                                <td><img src="{{ $images[$product->id]->path }}" alt=" " class="img-responsive" style="max-height: 140px; max-width: 140px;" /></td>
                                <td>{{ $product->sold }}</td>
                                <td><a href="{{ route('backend.category.show',$product->category_id) }}">{{\DB::table('categories')->where('id',$product->category_id)->value('name')}}</a></td>

                                <td>
                                    @can('update',$product)
                                    <a href="{{ route('backend.product.edit',$product->id)}}" class="btn btn-info">Sửa</a>
                                    @endcan
                                    <a href="{{ route('backend.product.showImages',$product->id)}}" class="btn btn-success">Ảnh</a>
                                    @can('delete',$product)
                                    <button class="btn btn-warning" data-toggle="tooltip" title="Xóa" onclick="event.preventDefault();deleteProduct({{ $product->id }})" >
                                        <i class="fa fa-btn fa-trash"></i>Xoá
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $products->links('vendor.pagination.bootstrap-4') !!}
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