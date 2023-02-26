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
							<td colspan="5" style="color: white">Mã đơn hàng {{ $order->id }}</td>
						</tr>
						<tr>
							<th style="text-align: center;" >STT</th>
							<th style="text-align: center;" >Tên sản phẩm</th>
							<th style="text-align: center;" >Số lượng</th>
							<th style="text-align: center;" >Đơn giá</th>
							<th style="text-align: center;" >Thành tiền</th>
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
                        <tr>
                        	<td>Tổng tiền</td>
                            <td colspan="4" style="text-align: right;">{{ number_format($order->money) }}</td>
                        </tr>
                        <tr>
                        	<td colspan="5" style="text-align: left;">
	                        @if($order->status==1)
		                        <form action="{{ route('backend.order.complete', $order->id ) }}" method="POST" style="display: inline;">
		                            {{ csrf_field() }}
		                            {{ method_field('PUT') }}
		                            <button type="submit" class="btn btn-success">
		                                Đã nhận hàng
		                            </button>
		                        </form>
	                        @endif
	                        <a href="{{ route('frontend.user.orders') }}" class="btn btn-default">Trở lại</a>
	                        </td>
                        </tr>
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