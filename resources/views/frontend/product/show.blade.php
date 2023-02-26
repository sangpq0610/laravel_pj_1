@extends('frontend.layouts.master')
@section('title')
Sản phẩm {{ $product->name }}
@endsection
@section('banner_content')
<!-- banner -->
	<div class="banner">
		
		<div class="w3l_banner_nav_right">
			<div class="agileinfo_single">
				<h5>{{ $product->name }}</h5>
				
                <div class="col-md-4 agileinfo_single_left">
					
					<img src="{{ $image->path }}" class="img-responsive">
					
				</div>
                
				<div class="col-md-8 agileinfo_single_right">
					{{-- <div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
					</div> --}}
					<div class="w3agile_description">
						<h4>Mô tả :</h4>
						<p>{{ $product->content }}</p>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4>{{ number_format($product->sale_price) }}VNĐ <span>{{ number_format($product->origin_price) }}</span></h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							<a href="{{ route('frontend.cart.add',$product->id) }}" class="btn btn-danger">THÊM VÀO GIỎ</a>
						</div>
					</div>
				</div>
				
				<div class="col-md-12" style="padding: 30px 0 0 0">
					<h3>Bình luận</h3>
				
			    	<div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0" nonce="vCUppsI8"></script>
                    <div class="fb-comments" data-href="{{ route('frontend.product.show', $product->id) }}" data-numposts="1" data-width="500"></div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
@endsection
@section('content')
<!-- brands -->
	<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_popular">
		<div class="container">
			<h3>Các Sản Phẩm Cùng Loại Khác</h3>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					@foreach($products as $value)
				<div class="col-md-3 w3ls_w3l_banner_left">
				<div class="hover14 column">
				<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
					<div class="agile_top_brand_left_grid1">
						<figure>
							<div class="snipcart-item block">
								<div class="snipcart-thumb">
									<a href="{{ route('frontend.product.show',$value->id) }}"><img src="{{ $images[$value->id]['path'] }}" alt=" " class="img-responsive" style="height: 140px; overflow-x: hidden;" /></a>
									<p>{{ $value->name }}</p>
									@if($value->sale_price < $value->origin_price)
									<h4>{{ number_format($value->sale_price) }}VNĐ <span>{{ number_format($value->origin_price) }}</span></h4>
									@else
									<h4>{{ number_format($value->origin_price) }}VNĐ <span></span></h4>
									@endif
								</div>
								<div class="snipcart-details">
									<a href="{{ route('frontend.cart.add',$value->id) }}" class="btn btn-danger">Thêm Vào Giỏ</a>
								</div>
							</div>
						</figure>
					</div>
				</div>
				</div>
			</div>
				@endforeach
					<div class="clearfix"> </div>
				</div>
		</div>
	</div>
<!-- //brands -->
@endsection

@section('newletter')
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
@endsection