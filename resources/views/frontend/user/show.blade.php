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
							<td class="invert-image"><a href="{{ route('frontend.product.show',$cartItem->id) }}"><img src="{{ $images[$cartItem->id]->path }}" alt=" " class="img-responsive"></a></td>
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
								<div class="rem">
									<div class="close1"><a href="{{route('frontend.cart.remove',$key)}}" style="display: inline-block; height: 100%;width: 100%">&nbsp</a></div>
								</div>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
			<div class="checkout-left">	
				<div class="col-md-4 checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
						@foreach($cart as $cartItem)
						<li>{{ $cartItem->name }} <i>-</i>{{ $cartItem->qty }} <span>{{ number_format($cartItem->price*$cartItem->qty)}}VNĐ </span></li>
						@endforeach
						<li>Total <i>-</i> <span>{{ \Cart::total() }}VNĐ</span></li>
					</ul>
				</div>
				<div class="col-md-8 address_form_agile">
					<div class="checkout-right-basket">
				        	<a href="payment.html">Xác nhận<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
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
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
@endsection