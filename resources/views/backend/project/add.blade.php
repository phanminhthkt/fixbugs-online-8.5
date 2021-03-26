@extends('backend.layouts.index')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="{{route('admin.index') }}"><i class="remixicon-home-8-line"></i></a></li>
               <li class="breadcrumb-item"><a href="{{$pageIndex}}">{{$title}}</a></li>
               <li class="breadcrumb-item active">Thêm {{$title}}</li>
            </ol>
         </div>
      </div>
   </div>
    <div class="col-12">
       @include('blocks.messages')
    </div>
  </div>
    <form role="form" class='needs-validation' method="POST" action="{{$pageIndex.'/store'}}" enctype="multipart/form-data" novalidate>
   @csrf
   <div class="row d-flex flex-sm-row-reverse">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header py-2">
            <h5 class="card-title mb-0">File đặc tả</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="dropzone">
              <div class="text-center">
                  <label for="file-taptin">
                    <p class="h1 text-muted"><i class="mdi mdi-cloud-upload"></i></p>
                    <h5>Kéo file vào đây</h5>
                    <div class="custom-file-dev fileupload">
                        <input type="file" class="custom-file" name="file" class="upload" id="file-taptin">
                    </div>
                    <div class="change-file"><b class="text-sm text-split text-danger"></b></div>
                  </label>
                  
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header py-2">
            <h5 class="card-title mb-0">THÔNG TIN CHUNG</h5>
        </div>
        <div class="card-body">
          
          <div class="form-group">
            <div class="row">
                <div class="col-sm-6 col-12">
                  <label>Sale phụ trách</label>
                  <select class="selectpicker" name="id_sale">
                      <option value="" >Chọn saler</option>
                        @foreach($sales as $v)
                        <option value="{{$v->id}}">
                        {{$v->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 col-12">
                    <label>Dev phụ trách</label>
                    <select class="selectpicker" name="id_dev">
                      <option value="" >Chọn dev</option>
                        @foreach($devs as $v)
                        <option value="{{$v->id}}">
                        {{$v->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                <div class="col-sm-6 col-12">
                    <label>Tình trạng lập trình</label>
                    <select class="selectpicker" name="id_status_code">
                        <option value="" >Chọn trạng thái</option>
                          @foreach($status_codes as $v)
                          <option value="{{$v->id}}">
                          {{$v->name}}
                          </option>
                          @endforeach
                        </select>
                </div>
                <div class="col-sm-6 col-12">
                    <label>Tình trạng dự án</label>
                    <select class="selectpicker" name="id_status_project">
                        <option value="" >Chọn trạng thái</option>
                          @foreach($status_projects as $v)
                          <option value="{{$v->id}}">
                          {{$v->name}}
                          </option>
                          @endforeach
                        </select>
                </div>
              </div>
            </div>
          
          
          <div class="form-group">
            <div class="row">

              <div class="col-sm-6 col-12">
                <div class="form-group">
                <label>Tình trạng</label>
                <select class="selectpicker" name="is_status">
                    <option value="1"> Hiển thị</option>
                    <option value="0"> Ẩn</option>
                </select>
              </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="priority">Thứ tự</label>
                    <input type="text" class="form-control" id="priority" name='is_priority' placeholder="Thứ tự" value="1">
                </div>
              </div>
            </div>
            
            <div class="form-group">
                
            </div>
            
          </div>
        </div>
      </div>
   </div>
   <div class="col-lg-8">
      <div class="card">
        <div class="card-header py-2 text-white">
            <h5 class="card-title mb-0">THÔNG TIN CHI TIẾT</h5>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs nav-bordered">
            <li class="nav-item">
                <a href="#vi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Việt</span> 
                </a>
            </li>
            <li class="nav-item d-none">
                <a href="#en" data-toggle="tab" aria-expanded="true" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Anh</span> 
                </a>
            </li>
            <li class="nav-item d-none">
                <a href="#kr" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Hàn</span>  
                </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active show" id="vi">
              <div class="form-group">
                <label>Tên dự án</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Dự án" value="{{old('name')}}" required="">
                    <div class="invalid-feedback">Vui lòng nhập tên dự án</div>
                  </div>
              </div>
              <div class="form-group">
                <label id="contract_code">Mã hợp đồng</label>
                <input type="text" class="form-control" id="contract_code" name="contract_code" placeholder="Mã hợp đồng" value="{{old('contract_code')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập mã hợp đồng</div>
              </div>
              <div class="form-group">
                <label id="link_design">Link design</label>
                <input type="text" class="form-control" id="link_design" name="link_design" placeholder="Link design" value="{{old('link_design')}}">
              </div>
              <div class="form-group">
                <label>Ghi chú</label>
                <div class="input-group">
                  <textarea rows="4" name="note" id="note" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="tab-pane fade d-none" id="en">Anh</div>
            <div class="tab-pane fade d-none" id="kr">Hàn</div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Submit</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
   </div>
   
</div>
 </form>


@endsection