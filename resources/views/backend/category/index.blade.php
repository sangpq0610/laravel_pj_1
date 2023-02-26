@extends('backend.layouts.master')
@section('title')
Danh sách hạng mục
@endsection
@section('css')

@endsection
@section('js')
<script type="text/javascript">
    function deleteCategory(id){
        swal({
          title: "Bạn có chắc muốn xóa danh mục này không?",
          text: "Hành động không thể hoàn tác",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "/admin/category/delete/"+id,
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
                <h1 class="m-0 text-dark">Danh sách danh mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách danh mục</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
</div>
@endsection
@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ( Session::has('msg') )
                <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('backend.category.create') }}" class="btn btn-primary">Tạo mới</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Thời gian tạo</th>
                                <th>Danh mục cha</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td><a href="{{ route('backend.category.show',$category->id)}}">{{$category->name}}</a></td>
                                <td>{{$category->created_at}}</td>
                                <td>{{$category->parent_id}}</td>
                                <td>
                                    <a href="{{ route('backend.category.showProducts',$category->id)}}" class="btn btn-success">Sản phẩm</a>

                                    <a href="{{ route('backend.category.edit',$category->id)}}" class="btn btn-info">Sửa</a>
                                    
                                    @can('delete',$category)
                                    <button class="btn btn-warning" data-toggle="tooltip" title="Xóa" onclick="event.preventDefault();deleteCategory({{ $category->id }})" >
                                        <i class="fa fa-btn fa-trash"></i>Xoá
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $categories->links('vendor.pagination.bootstrap-4') !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection