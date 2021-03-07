@extends('frontend.layouts.index')
@section('content')
<div class="login-4">
	<div class="form-section mw-800">
	    @include('blocks.messages')
	    <h3>Nghề nghiệp của bạn là gì ?</h3>
	    <form action="{{ route('frontend.put.member',Session('loginMember')['id']) }}" method="POST" class="needs-validation">
	    	<div class="row">
	    		@foreach ($dataJob as $job)
	    		<div class="col-md-6">
	    			<div class="item-job">
		    			<label for="job{{$job->id}}">
			    			<div class="job">
			    				<div class="pic-job"></div>
			    				<div class="content-job">
			    					<h3 class="content-job_name">{{$job->name}}</h3>
			    				</div>
			    			</div>
		    			</label>
		    			<input type="radio" name="is_job" value="{{$job->id}}" id="job{{$job->id}}">
		    		</div>
	    		</div>
	    		@endforeach
	    		<div class="form-group clearfix text-center">
		            <button type="submit" class="btn-md btn-theme float-left">GỬI</button>
		        </div>
	    	</div>
	    	@method('PUT')
	        @csrf
	    </form>
	</div>
</div>
@endsection        