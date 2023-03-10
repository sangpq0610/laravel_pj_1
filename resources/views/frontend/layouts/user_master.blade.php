<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link rel="icon" href="https://www.southeastpsych.com/wp-content/uploads/2015/05/s-no-background-1200x1200.png">
<link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<link rel="stylesheet" href="/backend/plugins/fontawesome-free/css/all.min.css">
<!-- js -->
<script src="/backend/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{ asset('frontend/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/easing.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
@yield('css')
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
	@include('frontend.includes.header')
	@yield('product-breadcrumb')
<!-- //header -->

<!-- banner -->
	<div class="banner">
		@include('frontend.includes.user_sidebar')
		<div class="w3l_banner_nav_right">
			@yield('banner_nav_right')
			@yield('banner_content')
		</div>
		<div class="clearfix"></div>
	</div>
<!-- banner -->

<!-- top-brands -->
	@yield('content')
<!-- //fresh-vegetables -->

<!-- newsletter -->
	@yield('newsletter')
<!-- //newsletter -->
<!-- footer -->
	@include('frontend.includes.footer')
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="{{ asset('frontend/js/minicart.js') }}"></script>
<script>
	paypal.minicart.render();

	paypal.minicart.cart.on('checkout', function (evt) {
		var items = this.items(),
			len = items.length,
			total = 0,
			i;

		// Count the number of each item in the cart
		for (i = 0; i < len; i++) {
			total += items[i].get('quantity');
		}

		if (total < 3) {
			alert('S??? l?????ng h??ng ?????t t???i thi???u l?? 3. H??y th??m s???n ph???m tr?????c khi thanh to??n');
			evt.preventDefault();
		}
	});

</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@include('sweetalert::alert')
	@yield('js')
</body>
</html>
