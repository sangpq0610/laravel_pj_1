@extends('backend.layouts.master')
@section('title')
Đơn hàng {{ $order->id }}
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
                            <li class="breadcrumb-item"><a href="{{ route('backend.order.index') }}"></a>Danh sách đơn hàng</li>
                            <li class="breadcrumb-item active">Đơn hàng {{ $order->id }}</li>
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
                        <h3 class="card-title">Đơn hàng {{ $order->id }}</h3>
                        <div class="card-tools">
                            <h3 class="card-title">Trạng thái: @if($order->status==0)
                                        Chờ xác nhận
                                    @elseif($order->status==1)
                                        Đang giao
                                    @else
                                        Đã hoàn thành
                                    @endif</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class=" table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th style="text-align: right;">Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="{{ route('backend.product.show',$product->id) }}">{{$product->name}}</a></td>
                                <td>{{ number_format($amount[$product->id]) }}</td>
                                <td>{{ number_format($product->sale_price)}}</td>
                                <td style="text-align: right;">{{ number_format($product->sale_price*$amount[$product->id]) }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-header">
                        <h3 class="card-title">Tổng tiền</h3>
                        <div class="card-tools" style="text-align: right;">
                            <p>{{ number_format($order->money) }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if($order->status==0)
                        <form action="{{ route('backend.order.confirm', $order->id ) }}" method="POST" style="display: inline;">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="btn btn-success">
                                Xác nhận
                            </button>
                        </form>
                        @endif
                        @if($order->status==1)
                        <form action="{{ route('backend.order.complete', $order->id ) }}" method="POST" style="display: inline;">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="btn btn-success">
                                Hoàn thành
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('backend.order.index') }}" class="btn btn-default">
                            Trở lại
                        </a>
                    </div>
                    
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
        </section>
@endsection