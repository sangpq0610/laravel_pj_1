@extends('frontend.layouts.master')
@section('title')
Liên hệ chúng tôi
@endsection
@section('banner_nav_right')
<!-- about -->
	<div class="privacy about">
		<h3>Liên hệ chúng tôi </h3>
		<div class="agileinfo_mail_grids">
			<div class="col-md-4 agileinfo_mail_grid_left">
				<ul>
					<li><i class="fa fa-home" aria-hidden="true"></i></li>
					<li>Địa chỉ<span>186 Phương Liệt, Thanh Xuân</span></li>
				</ul>
				<ul>
					<li><i class="fa fa-envelope" aria-hidden="true"></i></li>
					<li>email<span><a href="mailto:sang.pq183974@sis.hust.edu.vn" style="font-size: 12px">sang.pq183974@sis.hust.edu.vn</a></span></li>
				</ul>
				<ul>
					<li><i class="fa fa-phone" aria-hidden="true"></i></li>
					<li>SĐT<span>(+84) 984 701 585</span></li>
				</ul>
			</div>
			<div class="col-md-8 agileinfo_mail_grid_right">
				<form action="{{ route('submitContact') }}" method="post">
					@csrf
					<div class="col-md-6 wthree_contact_left_grid">
						<input type="text" name="name" 
						@if(null ==Auth::user())
						value="Họ và tên* "
						@else
						value="{{ Auth::user()->name }}"
						@endif
						 onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Họ và tên*';}" required="">
						<input type="email" name="email" 
						@if(null ==Auth::user())
						value="Email*"
						@else
						value="{{ Auth::user()->email }}"
						@endif
						 onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email*';}" required="">
					</div>
					<div class="col-md-6 wthree_contact_left_grid">
						<input type="text" name="phone" 
						@if(null ==Auth::user())
						value="SĐT*"
						@else
						value="{{ Auth::user()->phone }}"
						@endif
						 onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'SĐT*';}" required="">
						<input type="text" name="subject" value="Tiêu đề*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tiêu đề*';}" required="">
					</div>
					<div class="clearfix"> </div>
					<textarea name="content" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Lời nhắn...';}" required="">Lời nhắn...</textarea>
					<input type="submit" value="Xác nhận">
					<input type="reset" value="Hủy">
				</form>
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