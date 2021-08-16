<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\File; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Status;
use App\Models\Project;
use App\Models\GroupMember;
use App\Models\GroupStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMember;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(Project $project)
    {
        $this->_model = $project;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('api.project.index');
        $this->_data['table'] = 'projects';
        $this->_data['devs'] = Member::where('group_id','=', 1)->get();
        $this->_data['sales'] = Member::where('group_id','=', 2)->get();
        $this->_data['status_codes'] = Status::where('group_id','=', 1)->get();
        $this->_data['status_projects'] = Status::where('group_id','=', 2)->get();
        $this->_data['title'] = 'Dự án';
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        $sql  = $this->_model::with(['dev','saler','status_project','status_code'])->where('id','<>', 0);
        if($request->has('term')){
            $sql->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '?term='.$request->term;
        }
        $this->_data['items'] = $sql->orderBy('id','desc')->paginate(10)->withPath(url()->current().$this->_pathType);
        return response([
            $this->_data['items']
            // $this->_data
        ], 200);
        // return view('backend.project.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.project.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        
        $this->validate($request,
            [
                'name' => 'required',
                'contract_code' => 'required',
                'function' => 'required',
                'link_design' => 'required',
                'file' => 'required|mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048'
            ],          
            [
                'name.required' => 'Vui lòng nhập tên dự án',
                'contract_code.required' => 'Vui lòng nhập mã hợp đồng',
                'function.required' => 'Vui lòng nhập chức năng',
                'link_design.required' => 'Vui lòng nhập link design',
                'file.required' => 'Vui lòng tải tải lên file đặc tả',
                'file.mimes' => 'Chỉ chấp nhận file đuôi doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS',
                'file.max' => 'File giới hạn dung lượng không quá 2M',
            ]
        );

        if($request->hasFile('file')){    
            $file = $request->file('file');
            $nameFile =  time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/files'),$nameFile);
            $data['file'] =  $nameFile;
        }
        $data['ended_at'] =($request->has('ended_at') && $request->ended_at!='') ? Carbon::parse($request->ended_at)->format('Y-m-d H:i:s') :'' ;
        $data['estimated_at'] = ($request->has('estimated_at') && $request->estimated_at!='') ? Carbon::parse($request->estimated_at)->format('Y-m-d H:i:s') :'';
        $data['begin_at'] = ($request->has('begin_at') && $request->begin_at!='') ? Carbon::parse($request->begin_at)->format('Y-m-d H:i:s') :'';
        $data['received_at'] = ($request->has('received_at') && $request->received_at!='') ? Carbon::parse($request->received_at)->format('Y-m-d H:i:s') :'';
        if($projectId = $this->_model->create($data)->id){
            $project = $this->_model::find($projectId);
            $project->status()->attach([1,4]);
            return response()->json(
                [
                    'success' => 'Thêm dự án '. $request->name .' thành công'
                ],200
            );
        }else{
            return response()->json(
                [
                    'danger' => 'Thêm dự án '. $request->name .' thất bại.Xin vui lòng thử lại'
                ],500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->_data['item'] = $this->_model::with(['dev','saler','status_project','status_code'])->findOrFail($id);
        $this->_data['item']->begin_at = $this->_data['item']->begin_at != '' ? Carbon::parse($this->_data['item']->begin_at)->format('Y-m-d\TH:i') : '';
        $this->_data['item']->estimated_at = $this->_data['item']->estimated_at != '' ? Carbon::parse($this->_data['item']->estimated_at)->format('Y-m-d\TH:i') : '';
        $this->_data['item']->ended_at =$this->_data['item']->ended_at != '' ?  Carbon::parse($this->_data['item']->ended_at)->format('Y-m-d\TH:i') : '';
        return response([
            $this->_data['item']
            // $this->_data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = $this->_model->findOrFail($id);
        $data = $request->except('_token','_method');

        if ($request->has(['name', 'contract_code', 'function', 'link_design'])) {    
            $this->validate($request,
                [
                    'name' => 'required',
                    'contract_code' => 'required',
                    'function' => 'required',
                    'link_design' => 'required',
                ],          
                [
                    'name.required' => 'Vui lòng nhập tên dự án',
                    'contract_code.required' => 'Vui lòng nhập mã hợp đồng',
                    'function.required' => 'Vui lòng nhập chức năng',
                    'link_design.required' => 'Vui lòng nhập link design',
                ]
            );
        }
        if($request->hasFile('file')){
            $this->validate($request,
                [
                    'file' => 'required|mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048'
                ],          
                [
                    'file.mimes' => 'Chỉ chấp nhận file đuôi doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS',
                    'file.max' => 'File giới hạn dung lượng không quá 2M',
                ]
            );
            if($project->file!=''){
                 File::delete(public_path('uploads/files/').$project->file);
            }
            $file = $request->file('file');
            $nameFile =  time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/files'),$nameFile);
            $data['file'] =  $nameFile;
        }
        $data['ended_at'] =($request->has('ended_at') && $request->ended_at!='') ? Carbon::parse($request->ended_at)->format('Y-m-d H:i:s') :'' ;
        $data['estimated_at'] = ($request->has('estimated_at') && $request->estimated_at!='') ? Carbon::parse($request->estimated_at)->format('Y-m-d H:i:s') :'';
        $data['begin_at'] = ($request->has('begin_at') && $request->begin_at!='') ? Carbon::parse($request->begin_at)->format('Y-m-d H:i:s') :'';
        $data['received_at'] = ($request->has('received_at') && $request->received_at!='') ? Carbon::parse($request->received_at)->format('Y-m-d H:i:s') :'';

        if($project->where('id', $id)->update($data)){
            if($request->progress == 100) $project->status()->sync([3,4]);
            if($request->progress > 0 && $request->progress < 100) $project->status()->sync([2,4]);
            if($request->progress == 0) $project->status()->sync([1,4]);
            // $project->status()->sync([1,4]);
            return response()->json(
                [
                    'success' => 'Sửa dự án <strong>'. $request->name .'</strong> thành công'
                ],200
            ); 
        }else{
            return response()->json(
                [
                    'danger' => 'Sửa dự án <strong>'. $request->name .'</strong> thất bại.Xin vui lòng thử lại'
                ],200
            ); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = $this->_model->findOrFail($id);
        if($data->file!=''){
            File::delete(public_path('uploads/files/').$data->file);
        }
        if($this->_model->where('id', $id)->delete()){
            // $data->members()->detach();//Có thể ko cần xài nếu đã build cascade on delete
            // $data->status()->detach();
            return ['success' => true, 'message' => 'Xóa dự án thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa dự án thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        $dataFile = $this->_model->whereIn('id',explode(",",$listId))->where('file','<>','')->pluck('file');
        foreach($dataFile as $file){
            if(File::exists(public_path('uploads/files/').$file)) {
                File::delete(public_path('uploads/files/').$file);
            }
        } 
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            // DB::table('member_project')->whereIn('project_id',explode(",",$listId))->delete();
            // DB::table('project_status')->whereIn('project_id',explode(",",$listId))->delete();
            return ['success' => true, 'message' => 'Xóa dự án thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa dự án thất bại.Xin vui lòng thử lại !!'];
        }
    }

    public function sendMailMember(Request $request,$id)
    {
        $project = $this->_model->findOrFail($id);
        Mail::to([$project->dev->first()->email,$project->saler->first()->email])->send(new SendMember($project));
        if (Mail::failures()) {
            return response()->json(
                [
                    'error' => 'Gửi mail không thành công'
                ],200
            );
        }else{
            return response()->json(
                [
                    'success' => 'Thông tin đã được gửi mail'
                ],200
            ); 
        }
    }
}
