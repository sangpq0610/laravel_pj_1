@php
$cart = \Cart::content();
@endphp
<div class="agileits_header">
		<div class="w3l_offers">
			<a href="#">Khuyến mại hôm nay !</a>
		</div>
		<div class="w3l_search">
			<form action="{{ route('frontend.product.find') }}" method="get">
				<input type="text" name="key" placeholder="Tìm kiếm sản phẩm ..." required="" >
				<input type="submit" value=" ">
			</form>
			{{-- <script type="text/javascript">
				function search(search){
					$('#result').load('{{ route('frontend.product.search','sp') }}');
				}
			</script> --}}
		</div>
		{{-- <div id="result">
			@if(Session::has('result'))
			@foreach(Session::get('result') as $product)
			{{ $product->name }}
			@endforeach
			@else
			Tìm kiếm sản phẩm ...
			@endif
		</div> --}}
		<div class="product_list_header">
			
        	<input type="submit" id="checkout_button" value="Xem giỏ hàng" data-placement="bottom" class="button" data-toggle="tooltip" 
        	@if(\Cart::count()==0)
        	title="Giỏ hàng chưa có sản phẩm"
        	@else
			title="Thanh toán {{ \Cart::count() }} sản phẩm"
			@endif
        	onclick="hi()" />
        	<script type="text/javascript">
        		function hi(){
        	 		window.location = '{{ route('checkout') }}';
        	 	}
        	 	$(document).ready(function(){
        	 		$('#checkout_button').mouseover(function(){
        	 			$('#PPMiniCart').css('display', 'block');
        	 		});
        	 		$('.minicart-closer').on('click', function(){
        	 			$('#PPMiniCart').css('display', 'none');
        	 		});
        	 	});
        	 	function updateItem(){
        	 		var formData = new FormData();
        	 		@foreach($cart as $key => $cartItem)
        	 		formData.append('{{ $cartItem->id }}', $("#frmCart input[name='{{ $cartItem->id }}']").val());
        	 		@endforeach
        	 		$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('#frmCart meta[name="csrf-token"]').attr('content')
				        }
				    });
				    $.ajax({
				        type: 'POST',
				        url: '{!! route('frontend.cart.updateItem') !!}',
				        data:formData,
				        contentType: false,
				        processData: false,
				        cache:false,
				        success: function(data) {
				        },
				        error: function(data) {
				            console.log(data);
				        }
				    });
        	 	}
        	</script>
		</div>
		<div id="PPMiniCart">
			<form method="post" id="frmCart" class="" action="{{ route('frontend.cart.updateItem') }}" target="">
				<button type="button" class="minicart-closer">×</button>
				@if(\Cart::count()==0)
				<p class="minicart-empty-text">Giỏ hàng chưa có sản phẩm</p>
				@else
				<meta name="csrf-token" content="{{ csrf_token() }}" />
				<ul>
					@foreach($cart as $key => $cartItem)
					<li class="minicart-item minicart-item-changed">            
						<div class="minicart-details-name">                
							<a class="minicart-name" href="{{ route('frontend.product.show', $cartItem->id) }}">{{ $cartItem->name }}</a>
						</div>
						<div class="minicart-details-quantity">                
							<input class="minicart-quantity" data-minicart-idx="0" name="{{ $cartItem->id }}" type="text" pattern="[0-9]*" value="{{ $cartItem->qty }}" autocomplete="off" onchange="updateItem()">            
						</div>            
						<div class="minicart-details-remove">
							<a href="{{ route('frontend.cart.remove',$key) }}" class="minicart-remove" data-minicart-idx="0" style="text-align: center;">×</a>
						</div>            
						<div class="minicart-details-price">                
							<span class="minicart-price">{{ number_format($cartItem->price*$cartItem->qty) }} VNĐ</span>            
						</div>
					</li>
					@endforeach
				</ul>    
				<div class="minicart-footer">                    
					<div class="minicart-subtotal">
						Tổng: {{ number_format(\Cart::total()) }} VNĐ
					</div>            
					<a class="submit-cart" href="{{ route('checkout') }}" style="text-align: center; line-height: 33px;">Thanh toán</a>
				</div>
				@endif
			</form>
		</div>

		
		<div class="w3l_header_right1" >
			<div class="w3l_header_right" style="float: right; padding: 0px">
				<ul>
					<li class="dropdown profile_details_drop">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 0px 10px 0 0;line-height: 46px"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
						@if(null == Auth::user())
						<div class="mega-dropdown-menu">
							<div class="w3ls_vegetables">
								<ul class="dropdown-menu drp-mnu">
									<li><a href="{{ route('login') }}">Đăng nhập</a></li> 
									<li><a href="{{ route('register') }}">Đăng kí</a></li>
								</ul>
							</div>                  
						</div>
						@else
						<div class="mega-dropdown-menu">
							<div class="w3ls_vegetables">
								<ul class="dropdown-menu drp-mnu">
									@if(Auth::user()->role != 0)
									<li><a href="{{ route('backend.dashboard') }}">Quản lý</a></li>
									@endif
									<li><a href="{{ route('frontend.user.orders') }}">Đơn của tôi</a></li>
									<li>
										<a href="{{ route('logout') }}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
				                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
				                        	@csrf
				                        </form>
	                    			</li>
								</ul>
							</div>                  
						</div>
						@endif
					</li>
				</ul>
			</div>
			@if(null != Auth::user())
			<h2 style="font-size: 24px"><a href="{{ route('frontend.user.edit') }}" style="padding: 13px 34px 14px 27px" >{{ Auth::user()->name }}</a></h2>
			@endif
		</div>
		
		<div class="clearfix"> </div>
	</div>
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left">
				<h1><a href="{{ route('index') }}" style="font-family: Arial; font-weight: 900;"><span style="font-family: Helvetica; font-weight: 900;">Hàng Chè</span> Online</a></h1>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="special_items">
					<li><a href="{{ route('contact') }}">Liên hệ</a><i></i></li>
				</ul>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+84) 984 701 585</li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:sang.pq183974@sis.hust.edu.vn">sang.pq183974@sis.hust.edu.vn</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>