<div class="d-inline-flex justify-content-end">
    <div class="form-inline form-search d-inline-block align-middle ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="" >
            <div class="input-group-append bg-primary rounded-right">
                <button class="btn btn-secondary text-white" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <a class="btn  btn-secondary bg-gradient-primary text-white  ml-1" 
      href="{{url()->current().'/add'}}" title="Thêm mới"><i class="mdi mdi-plus-circle"></i></a>
    <a class="btn  btn-danger bg-gradient-danger text-white ml-1" id="delete-all" data-url="" title="Xóa tất cả"><i class="far fa-trash-alt "></i></a>
</div>