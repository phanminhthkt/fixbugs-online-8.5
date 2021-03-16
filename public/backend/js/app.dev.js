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
function deleteItem(data)
{
    $.ajax({
    	url:data.url,
    	type: 'DELETE',
    	data: { _token: data.token,
                id: data.id
        },
	    success: function(result){
	    	location.reload();
	    }
	});
}

/* Delete all */
function deleteAll(url)
{
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
    document.location = url+"&listid="+listid;
}

$('body').on('click','#delete-item', function(){
	var data = data || {};
		data.url = $(this).data("url");
		data.token = $(this).data("token");
		data.method = $(this).data("method");
		data.id = $(this).data("id");
	confirmDialog("delete-item","Bạn có chắc muốn xóa mục này ?",data);
});

$('body').on('click','.dev-checkbox',function(){
	var id = $(this).data('id'),
		table = $(this).data('table'),
		kind = $(this).data('kind'),
		token = $(this).data('token'),
		$this = $(this);
	$.ajax({
    	url:'ajax/status/'+id,
    	type: 'PUT',
    	data: { _token: token,
                id: id,
                table: table,
                kind: kind
        },
	    success: function(result){
	    	if($this.is(':checked')) $this.prop('checked',false);
			else $this.prop('checked',true);
	    }
	});
	return false;
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
    	data: { _token: token,
                id: id,
                table: table,
                value: value
        },
	    success: function(result){
	    	if($this.is(':checked')) $this.prop('checked',false);
			else $this.prop('checked',true);
	    }
	});
	return false;
})