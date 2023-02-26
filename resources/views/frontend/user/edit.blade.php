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
							<th style="text-align: center;" colspan="2">Thông tin cá nhân</th>
						</tr>
					</thead>
					<tbody>
					<form role="form" action="{{ route('frontend.user.update',$user->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
						<tr class="rem">
							<td class="invert">Họ và Tên</td>
							<td class="invert"><input type="text" class="form-control" id="" placeholder="Tên người dùng" name="name" value="{{ Auth::user()->name }}"></td>
						</tr>
						<tr class="rem">
							<td class="invert">Email</td>
							<td class="invert"><input type="email" class="form-control" id="" placeholder="Email" name="email" value="{{ Auth::user()->email }}"></td>
						</tr>
						<tr class="rem">
							<td class="invert">SĐT</td>
							<td class="invert"><input type="text" class="form-control" id="" name="phone" value="{{ Auth::user()->phone }}"></td>
						</tr>
						<tr class="rem">
							<td class="invert">Địa chỉ</td>
							<td class="invert"><input type="text" class="form-control" id="" name="address" value="{{ Auth::user()->address }}"></td>
						</tr>
						<tr class="rem">
							<td class="invert">Mật khẩu mới</td>
							<td class="invert"><input type="password" class="form-control" id="" name="password"></td>
						</tr>
						<tr class="rem"><td colspan="2"><button type="submit" class="btn btn-success">Cập nhật</button></td></tr>
					</form>
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
<script src="js/jquery-1.11.1.min.js"></script>
 <!--quantity-->
<!-- //js -->
@endsection