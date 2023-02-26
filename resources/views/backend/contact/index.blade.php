@extends('backend.layouts.master')
@section('title')
Danh sách hạng mục
@endsection
@section('css')

@endsection
@section('js')
<script type="text/javascript">
    function deleteContact(id){
        swal({
          title: "Bạn có chắc muốn xóa liên hệ này không?",
          text: "Hành động không thể hoàn tác",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "/admin/contact/delete/"+id,
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
                <h1 class="m-0 text-dark">Danh sách liên hệ</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách liên hệ</li>
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
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Thời gian</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <td>{{$contact->id}}</td>
                                <td><a href="{{ route('backend.contact.show',$contact->id)}}">{{$contact->name}}</a></td>
                                <td>{{$contact->created_at}}</td>
                                <td>{{$contact->parent_id}}</td>
                                <td>
                                    <a href="{{ route('backend.contact.show',$contact->id)}}" class="btn btn-success">Chi tiết</a>
                                    <button class="btn btn-warning" data-toggle="tooltip" title="Xóa" onclick="event.preventDefault();deleteContact({{ $contact->id }})" >
                                        <i class="fa fa-btn fa-trash"></i>Xoá
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $contacts->links('vendor.pagination.bootstrap-4') !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection