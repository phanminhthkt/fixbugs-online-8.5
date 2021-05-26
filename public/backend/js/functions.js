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
		error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	console.log(result);
	    }
	});
}