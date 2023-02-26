@extends('frontend.layouts.user_master')
@section('title')
Cập nhật
@endsection
@section('banner_nav_right')
<!-- about -->
		<div class="privacy about">
	      	<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th style="text-align: center;" >Mã đơn hàng</th>
							<th style="text-align: center;" >Thành tiền</th>
							<th style="text-align: center;" >Thời gian đặt</th>
							<th style="text-align: center;" >Trạng thái</th>
							<th style="text-align: center;" >Hành động</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $order)
						<tr class="rem">
							<td class="invert">{{ $order->id }}</td>
							<td class="invert" style="text-align: right;">{{ number_format($order->money) }}</td>
							<td>{{ $order->created_at }}</td>
							<td>
								@if($order->status==0)
                                    <a href="#" class="btn btn-warning" data-toggle="tooltip" title="Chờ xác nhận" data-placement="top" ><i class="fas fa-clock"></i></a>
                                @elseif($order->status==1)
                                    <a href="#" class="btn btn-primary" data-toggle="tooltip" title="Đang giao" data-placement="top" ><i class="fas fa-truck"></i></a>
                                @else
                                    <a href="#" class="btn btn-success" data-toggle="tooltip" title="Đã hoàn thành" data-placement="top" ><i class="fas fa-check"></i></a>
                                @endif
							</td>
							<td>
                                <a href="{{ route('frontend.user.showOrder',$order->id)}}" class="btn btn-primary">Chi tiết</a>
                                @if($order->status==1)
                                <form action="{{ route('backend.order.complete', $order->id ) }}" method="POST" style="display: inline;">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <button type="submit" class="btn btn-success">
                                        Hoàn thành
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('backend.order.delete', $order->id ) }}" method="POST" style="display: inline;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    @can('delete',$order)
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa fa-btn fa-trash"></i>Xoá
                                    </button>
                                    @endcan
                                </form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
<!-- //about -->
@endsection
@section('content')
@endsection

@section('newsletter')
	@if(null ==Auth::user())
	<div class="newsletter">
		<div class="container">
			<div class="w3agile_newsletter_left">
				<h3>sign up for our newsletter</h3>
			</div>
			<div class="w3agile_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<input type="submit" value="subscribe now">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	@endif
@endsection

@section('js')
<!-- js -->
 <!--quantity-->
<!-- //js -->
@endsection