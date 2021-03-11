<div id="alert-container">
	@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{!! $error !!}</li>
	        @endforeach
	    </ul>
	</div>
	@endif

	@if(session('danger'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	    {!! session('danger')!!}
	</div>
	@endif

	@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		{!! session('success') !!}
	</div>
	@endif
    
</div>