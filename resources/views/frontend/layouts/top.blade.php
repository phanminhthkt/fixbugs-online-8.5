<meta charset="utf-8">
<title>Fixbugs Online</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Fixbugs Online by Minh Martin." name="description">
<meta content="Minh Martin" name="author">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('public/frontend')}}/images/favicon.ico">
<!-- App css -->
<link href="{{asset('public/frontend')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontend')}}/css/app.dev.css" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontend')}}/css/app.dev.responsive.css" rel="stylesheet" type="text/css">
<!-- <script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
</script> -->