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

/* Delete */
function deleteItem(data)
{
    $.ajax({
    	url:data.url,
    	type: 'DELETE',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { listId: data.listId },
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	location.reload();
	    }
	});
}

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
$('body').on('click','#delete-all', function(){
	var data = data || {};
		data.url = $(this).data("url");
	var listId = "";
    $("input.select-checkbox").each(function(){
        if(this.checked) listId = listId+","+this.value;
    });
    listId = listId.substr(1);
    if(listId == "")
    {
    	notifyDialog("Bạn hãy chọn ít nhất 1 mục để xóa");
    	return false;
    }	
    data.listId = listId;
	confirmDialog("delete-all","Bạn có chắc muốn xóa mục này ?",data);
});

$('body').on('click','.delete-item', function(){
	var data = data || {};
		data.url = $(this).data("url");
		data.id = $(this).data("id");
	confirmDialog("delete-item","Bạn có chắc muốn xóa mục này ?",data);
});



$('body').on('click','#selectall-checkbox', function(){
	var parentTable = $(this).parents('table');
	var input = parentTable.find('input.select-checkbox');
	if($(this).is(':checked'))
	{
		input.each(function(){
			$(this).prop('checked',true);
		});
	}
	else
	{
		input.each(function(){
			$(this).prop('checked',false); 
		});
	}
});

$('body').on('click','.dev-checkbox',function(){
	var id = $(this).data('id'),
		table = $(this).data('table'),
		kind = $(this).data('kind'),
		$this = $(this);
	$.ajax({
    	url:'ajax/status/'+id,
    	type: 'PUT',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { id: id,table: table,kind: kind},
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    }
	    
	});
})
$('body').on('keyup','.input-priority',function(){
	var id = $(this).data('id'),
		table = $(this).data('table'),
		token = $(this).data('token'),
		value = $(this).val(),
		$this = $(this);
	$.ajax({
    	url:'ajax/priority/'+id,
    	type: 'PUT',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: {id: id,table: table,value: value},
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    }
	    
	});
	return false;
})
// Active menu third
if(URL.type!=''){
	$('.mm-active ul li a').each(function(i,v){
	    if($(this).attr('href').indexOf(URL.type) != -1){
	        $(this).addClass('waves-effect active');
	    }
	})
}
// End active menu third