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
	    <h3>ĐĂNG NHẬP</h3>
	    <form action="{{ route('frontend.post.login') }}" method="POST" class="needs-validation">
	        <div class="form-group form-box">
	            <input type="text" name="email" class="input-text" placeholder="Email hoặc Tên đăng nhập">
	             <div class="invalid-feedback mt-1">
	                Vui lòng nhập tên đăng nhập.
	            </div>
	        </div>
	        <div class="form-group form-box">
	            <input type="password" name="password" class="input-text" placeholder="Mật khẩu">
	             <div class="invalid-feedback mt-1">
	                Vui lòng nhập mật khẩu.
	            </div>
	        </div>
	        <div class="form-group clearfix">
	            <button type="submit" class="btn-md btn-theme float-left">Đăng nhập</button>
	            <a href="forgot-password-4.html" class="forgot-password">Quên mật khẩu</a>
	        </div>
	        @csrf
	    </form>
	    <p>Chưa có tài khoản? <a href="{{route('frontend.show.register')}}" class="thembo"> Đăng ký</a></p>
	</div>
</div>
@endsection        