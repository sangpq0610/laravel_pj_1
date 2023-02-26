@extends('backend.layouts.master')
@section('title')
Danh sách người dùng
@endsection
@section('css')
    
@endsection
@section('js')
<script type="text/javascript">
    function deleteUser(id){
        swal({
          title: "Bạn có chắc muốn xóa người dùng này không?",
          text: "Hành động không thể hoàn tác",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "/admin/user/delete/"+id,
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
                        <h1 class="m-0 text-dark">Danh sách người dùng</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách người dùng</li>
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
                        <a href="{{ route('backend.user.create') }}" class="btn btn-primary">Tạo mới</a>
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
                                <th>Email</th>
                                <th>Tên</th>
                                <th>Quyền</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            @if($user->id != Auth::user()->id)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('backend.user.show',$user->id) }}">{{ $user->name }}</a></td>
                                <td>
                                @if($user->role==1||$user->role==2)
                                Admin
                                @else
                                User
                                @endif
                                </td>
                                <td>
                                    <a href="{{ route('backend.user.showProducts',$user->id)}}" class="btn btn-success">Sản phẩm</a>
                                    @can('update',$user)
                                    <a href="{{ route('backend.user.edit',$user->id)}}" class="btn btn-info">Sửa</a>
                                    @endcan
                                    @can('delete',$user)
                                    <button class="btn btn-warning" data-toggle="tooltip" title="Xóa" onclick="event.preventDefault();deleteUser({{ $user->id }})" >
                                        <i class="fa fa-btn fa-trash"></i>Xoá
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        {!! $users->links() !!}
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