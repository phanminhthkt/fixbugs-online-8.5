<div id="alert-container">
	@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{!! $error !!}</li>
	        @endforeach
	    </ul>
	</div>
	@endif
	
	@if(session('danger'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <p> {{ session('danger')}}. </p>
	  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
    	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('success') }}
    </div>
    @endif
</div>