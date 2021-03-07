@extends('frontend.layouts.index')
@section('content')
<div class="login-4">
	<div class="form-section">
	    <!-- <div class="logo-2">
	        <a href="#">
	            <img src="assets/img/logos/logo-2.png" alt="logo">
	        </a>
	    </div> -->
	    @include('blocks.messages')
	    <h3>TẠO TÀI KHOẢN</h3>
	    <form action="{{ route('frontend.post.register') }}" method="POST" class="needs-validation" novalidate>
	    	
	        <div class="form-group form-box">
	            <input type="text" name="username" value="{{old('username')}}" class="input-text form-control" placeholder="Tên đăng nhập" required>
	            <div class="invalid-feedback mt-1">
	                Vui lòng nhập tên đăng nhập.
	            </div>
	        </div>
	        <div class="form-group form-box">
	            <input type="password" name="password" class="input-text form-control" placeholder="Mật khẩu" required>
	            <div class="invalid-feedback mt-1">
	                Vui lòng nhập mật khẩu.
	            </div>
	        </div>
	        <div class="form-group form-box">
	            <input type="password" name="password_confirmation" class="input-text form-control" placeholder="Nhập lại mật khẩu" required>
	            <div class="invalid-feedback mt-1">
	                Vui lòng xác nhận lại mật khẩu.
	            </div>
	        </div>
	        <div class="form-group form-box">
	            <input type="text" name="name" value="{{old('name')}}" class="input-text form-control" placeholder="Họ và tên" required>
	            <div class="invalid-feedback mt-1">
	                Vui lòng nhập họ tên.
	            </div>
	        </div>
	        <div class="form-group form-box">
	            <input type="email" name="email" value="{{old('email')}}" class="input-text form-control" placeholder="Email" required>
	            <div class="invalid-feedback mt-1">
	                Vui lòng nhập địa chỉ email.
	            </div>
	        </div>
	        <div class="form-group clearfix text-center">
	            <button type="submit" class="btn-md btn-theme float-left">Đăng ký</button>
	        </div>
	        {{ csrf_field() }}
	    </form>
	    <p>Bạn đã là thành viên ? <a href="{{route('frontend.show.login')}}" class="thembo"> Đăng nhập</a></p>
	</div>
</div>
@endsection