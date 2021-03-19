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

/* Delete */
function deleteItem(data)
{
    $.ajax({
    	url:data.url,
    	type: 'DELETE',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { id: data.id },
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
	    success: function(result){
	    	location.reload();
	    }
	});
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

$('body').on('click','#delete-item', function(){
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
	    success: function(result){
	    }
	});
	return false;
})