@extends('frontend.layouts.master')
@section('title')
Check Out
@endsection
@section('banner_nav_right')
<!-- about -->
			<div class="privacy about">
			<h3>THANH TOÁN</h3>
			
	      	<div class="checkout-right">
	      		@if(\Cart::count()<=0)
				<h4>Giỏ hàng Chưa có Sản phẩm nào</span></h4>
				@else
				<h4>Giỏ hàng có: <span>{{ \Cart::count() }} Sản phẩm</span></h4>
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>Sản phẩm</th>
							<th>Số Lượng</th>
							<th>Tên Sản Phẩm</th>
							<th>Giá bán</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $key => $cartItem)
						<tr class="rem">
							<td class="invert-image" style="max-width: 300px;"><a href="{{ route('frontend.product.show',$cartItem->id) }}"><img src="{{ $images[$cartItem->id]->path }}" class="img-responsive"></a></td>
							<td class="invert">
								<div class="quantity">
									<div class="quantity-select">
										<div class="entry value-minus"><a href="{{route('frontend.cart.minus',$key)}}" style="display: inline-block; height: 100%;width: 100%"></a></div>
										<div class="entry value"><span>{{ $cartItem->qty }}</span></div>
										<div class="entry value-plus active"><a href="{{route('frontend.cart.plus',$key)}}" style="display: inline-block; height: 100%;width: 100%"></a></div>
									</div>
								</div>
							</td>
							<td class="invert">{{ $cartItem->name }}</td>
							
							<td class="invert">{{ number_format($cartItem->price) }}VNĐ</td>
							<td class="invert">
								<div class="close1"><a href="{{route('frontend.cart.remove',$key)}}" style="display: inline-block; height: 100%;width: 100%">&nbsp</a></div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
			<div class="checkout-left">	
				<div class="col-md-4 checkout-left-basket" style="padding: 0px; border: #84c639 solid 2px;">
					<h4>hóa đơn</h4>
					<ul style="padding: 0px 10px;">
						@foreach($cart as $cartItem)
						<li>{{ $cartItem->name }} x{{ $cartItem->qty }} <span style="font-weight: bold;">{{ number_format($cartItem->price*$cartItem->qty)}}VNĐ </span></li>
						@endforeach
						<li style="border-top: #84c639 solid 2px; padding: 10px 0px;">Tổng cộng <i>-</i> <span style="font-weight: bold;">{{ number_format(\Cart::total()) }}VNĐ</span></li>
					</ul>
				</div>
				<div class="col-md-8 address_form_agile">
					<div class="checkout-right-basket">
				        	<a href="{{ route('frontend.cart.confirm') }}">Xác nhận<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
			      	</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- //about -->
@endsection
@section('content')
@endsection

@section('newsletter')
	
@endsection

@section('js')
<!-- js -->
 <!--quantity-->
<!-- //js -->
@endsection