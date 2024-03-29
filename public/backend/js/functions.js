// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()

$.fn.exists = function(){
    return this.length;
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    
// Alert
function notifyDialog(text)
{
	const swalconst = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-info text-sm',
		},
		buttonsStyling: false
	})
	swalconst.fire({
		text: text,
		icon: "warning",
		confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
		showClass: {
			popup: 'animated fadeIn faster'
		},
		hideClass: {
			popup: 'animated fadeOut faster'
		}
	})
}	
function notifyError(text)
{
	const swalconst = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-danger text-sm',
		},
		buttonsStyling: false
	})
	swalconst.fire({
		text: text,
		icon: "error",
		confirmButtonText: '<i class="fas fa-times mr-2"></i>Xảy ra lỗi',
		showClass: {
			popup: 'animated fadeIn faster'
		},
		hideClass: {
			popup: 'animated fadeOut faster'
		}
	})
}	
function confirmDialog(action,text,value)
{
	const swalconst = Swal.mixin({
		customClass: {
			confirmButton: 'btn  btn-info text-sm mr-2',
			cancelButton: 'btn  btn-danger text-sm'
		},
		buttonsStyling: false
	})
	swalconst.fire({
		text: text,
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: '<i class="fas fa-check mr-1"></i>Đồng ý',
		cancelButtonText: '<i class="mdi mdi-close mr-1"></i>Hủy',
		showClass: {
			popup: 'animated zoomIn faster'
		},
		hideClass: {
			popup: 'animated fadeOut faster'
		}
	}).then((result) => {
		if(result.value)
		{
			if(action == "delete-item") deleteItem(value);
			if(action == "delete-all") deleteAll(value);
			if(action == "send-mail-item") sendMail(value);
		}
	})
}
// End alert

function backErrorAjax(x,e){
    if (x.status==0) {
        notifyError('You are offline!!\n Please Check Your Network.');
    } else if(x.status==404) {
        notifyError('Requested URL not found.');
    } else if(x.status==500) {
        notifyError('Internel Server Error.');
    } else if(e=='parsererror') {
        notifyError('Error.\nParsing JSON Request failed.');
    } else if(e=='timeout'){
        notifyError('Request Time out.');
    } else {
        notifyError('Unknow Error.\n'+x.responseText);
    }
}
/* Delete */
function sendMail(data)
{
    $.ajax({
    	url:data.url,
    	type: 'GET',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { id: data.id },
	    beforeSend: function() {
	        // setting a timeout

	        $('.send-mail-item-'+data.id).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
	    },
    	error:function(x,e) {
		    $('.send-mail-item-'+data.id).html('<i class="mdi mdi-cancel"></i>');
		},
	    success: function(result){
	    	$('meta[name="csrf-token"]').attr('content',result.token);
	    	$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			if(result.status == "true"){
				$('.send-mail-item-'+data.id).html('<i class="mdi mdi-check-circle-outline"></i>');
			}
			else{
				$('.send-mail-item-'+data.id).html('<i class="mdi mdi-cancel"></i>');
			}
	    }
	});
}

/* Delete */
function deleteItem(data)
{
    $.ajax({
    	url:data.url,
    	type: 'DELETE',
    	// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { id: data.id },
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	location.reload();
	    }
	});
}

/* Delete all */
function deleteAll(data)
{
    $.ajax({
    	url:data.url+'/'+data.listId,
    	type: 'DELETE',
    	// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { listId: data.listId },
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	location.reload();
	    }
	});
}

function login(id)
{
	event.preventDefault();
	$.ajax({
		url: 'login',
		type: 'post',
		data:$(id).serialize(),
		dataType: 'json',
		beforeSend: function() {
	        // setting a timeout
	        $("#form-login button[type='submit']").html('<span class="spinner-border spinner-border-sm mr-1"></span>Loading...');
	    },
		error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	$('meta[name="csrf-token"]').attr('content',result.token);
	    	$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$("#form-login button[type='submit']").html('Đăng nhập');
			if(result.status=='true'){
				$(".text-response").html('<span class="d-block alert alert-success mt-2"></span>');
				window.location = result.url_intended;
			}else{
				$(".text-response").html('<span class="d-block alert alert-danger mt-2"></span>');
			}
			$(".text-response span").text(result.msg);
	    }
	});
}

