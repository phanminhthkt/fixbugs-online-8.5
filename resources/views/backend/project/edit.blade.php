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
               <li class="breadcrumb-item active">Sửa {{$title}}</li>
            </ol>
         </div>
      </div>
   </div>
    <div class="col-12">
       @include('blocks.messages')
    </div>
  </div>
  <form 
  class='needs-validation'
  role="form" 
  method="POST" 
  action="{{$pageIndex.'/update/'.$item->id.$path_type}}" 
  enctype="multipart/form-data" 
  novalidate >
   @csrf
   {{ method_field('PUT') }}
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
                    <div class="change-file">
                      <b class="text-sm text-split text-danger">{{$item->file}}</b>
                    </div>
                  </label>

                </div>
            </div>
          </div>
          @if($item->file!='')
          <div class="text-center">
            <a 
              href="{{public_path('uploads/files').$item->file}}" 
              >
            <b class="btn btn-outline-warning waves-effect waves-light d-inline-block"><i class="fa fa-download mr-1"></i>Tải file</b></a>
            <a 
              href="http://docs.google.com/gview?url={{public_path('uploads/files').$item->file}}&embedded=true"
              target="_blank" 
            >
              <b class="btn btn-outline-success waves-effect waves-light d-inline-block"><i class="fa fa-eye mr-1"></i>Xem file</b>
            </a>
          </div>        
          @endif
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
                  <select class="selectpicker" data-live-search="true"  name="group_member[]" required="">
                      <option value="" >Chọn saler</option>
                        @foreach($sales as $v)
                        <option 
                        value="{{$v->id}}"
                        {{ @$item->saler->first()->id == $v->id ? 'selected' : ''}}
                        >
                        {{$v->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 col-12">
                    <label>Dev phụ trách</label>
                    <select class="selectpicker" data-live-search="true" name="group_member[]" required="">
                      <option value="" >Chọn dev</option>
                        @foreach($devs as $v)
                        <option 
                        value="{{$v->id}}"
                        {{ @$item->dev->first()->id == $v->id ? 'selected' : ''}}
                        >
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
                    <select class="selectpicker" data-live-search="true" name="group_status[]" required="">
                      @foreach($status_codes as $v)
                      <option 
                      value="{{$v->id}}"
                      {{ @$item->status_code->first()->id == $v->id ? 'selected' : ''}}
                      >
                      {{$v->name}}
                      </option>
                      @endforeach
                    </select>
                </div>
                <div class="col-sm-6 col-12">
                    <label>Tình trạng dự án</label>
                    <select class="selectpicker" data-live-search="true" name="group_status[]" required="">
                      @foreach($status_projects as $v)
                      <option 
                      value="{{$v->id}}"
                      {{ @$item->status_project->first()->id == $v->id ? 'selected' : ''}}
                      >
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
                    <option value="1" {{ $item->is_status == 1 ? 'selected' : ''}}> Hiển thị</option>
                    <option value="0" {{ $item->is_status == 0 ? 'selected' : ''}}> Ẩn</option>
                </select>
              </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="priority">Thứ tự</label>
                    <input type="text" class="form-control" id="priority" name='is_priority' placeholder="Thứ tự" value="{{$item->is_priority}}">
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
            <h5 class="card-title mb-0">TIẾN ĐỘ LẬP TRÌNH</h5>
        </div>
        <div class="card-body">
          <div class="row">
             <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="received_at">Ngày nhận</label>
                  <div class="input-group">
                    <input 
                      type="text" 
                      name="received_at" 
                      class="form-control flatpickr-input" 
                      id="received_at" 
                      value="{{\Carbon\Carbon::parse($item->received_at)->format('d-m-Y H:i')}}"  
                      readonly="readonly"
                      placeholder="Ngày giao dự án"
                      >
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                    </div>
                  </div>
                  <div class="invalid-feedback">Vui lòng chọn ngày giao</div>
                </div>
             </div>
             <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="begin_at">Ngày lập trình</label>
                  <div class="input-group">
                    <input 
                      type="text" 
                      name="begin_at" 
                      class="form-control flatpickr-input" 
                      format="d-m-Y H:i:s" 
                      enabletime="true" 
                      data-input="" 
                      id="begin_at" 
                      value="{{\Carbon\Carbon::parse($item->begin_at)->format('d-m-Y H:i')}}" 
                      readonly="readonly"
                      placeholder="Ngày lập trình"
                      >
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                    </div>
                  </div>
                  <div class="invalid-feedback">Vui lòng chọn ngày lập trình</div>
                </div>
             </div>
             <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="estimated_at">Ngày dự kiến hoàn thành</label>
                  <div class="input-group">
                    <input 
                      type="text" 
                      name="estimated_at" 
                      class="form-control flatpickr-input" 
                      id="estimated_at" 
                      value="{{\Carbon\Carbon::parse($item->estimated_at)->format('d-m-Y H:i')}}" 
                      readonly="readonly"
                      placeholder="Ngày dự kiến hoàn thành"
                      >
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                    </div>
                  </div>
                  <div class="invalid-feedback">Vui lòng chọn dự kiến</div>
                </div>
             </div>
             <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="ended_at">Ngày hoàn thành</label>
                  <div class="input-group">
                      <input 
                      type="text" 
                      name="ended_at" 
                      class="form-control flatpickr-input" 
                      format="d-m-Y H:i:s" 
                      enabletime="true" 
                      data-input="" 
                      id="ended_at" 
                      value="{{\Carbon\Carbon::parse($item->ended_at)->format('d-m-Y H:i')}}" 
                      readonly="readonly"
                      placeholder="Ngày hoàn thành"
                      >
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                    </div>
                  <div class="invalid-feedback">Vui lòng chọn ngày giao</div>
                </div>
             </div>
          </div>
        </div>
        </div>
      </div>
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Dự án" value="{{$item->name}}" required="">
                    <div class="invalid-feedback">Vui lòng nhập tên dự án</div>
                  </div>
              </div>
              <div class="form-group">
                <label id="contract_code">Mã hợp đồng</label>
                <input type="text" class="form-control" id="contract_code" name="contract_code" placeholder="Mã hợp đồng" value="{{$item->contract_code}}" required="">
                <div class="invalid-feedback">Vui lòng nhập mã hợp đồng</div>
              </div>
              <div class="form-group">
                <label id="link_design">Link design</label>
                <input type="text" class="form-control" id="link_design" name="link_design" placeholder="Link design" value="{{$item->link_design}}">
              </div>
              <div class="form-group">
                <label>Ghi chú</label>
                <div class="input-group">
                  <textarea rows="4" name="note" id="note" class="form-control">{{$item->note}}</textarea>
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