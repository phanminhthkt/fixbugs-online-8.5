<?php

namespace App\Http\Controllers\Backend;
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
        $this->_data['pageIndex'] = route('admin.project.index');
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
        return view('backend.project.index', $this->_data);
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
        if($request->hasFile('file')){
            $this->validate($request,[
                    'file' => 'mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048',],          
                [
                    'file.mimes' => 'Chỉ chấp nhận file đuôi doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS',
                    'file.max' => 'File giới hạn dung lượng không quá 2M',
                ]
            );
            $file = $request->file('file');
            $nameFile =  time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/files'),$nameFile);
            $data['file'] =  $nameFile;
        }
        $data['ended_at'] = Carbon::parse($request->ended_at)->format('Y-m-d H:i:s');
        $data['estimated_at'] = Carbon::parse($request->estimated_at)->format('Y-m-d H:i:s');
        $data['begin_at'] = Carbon::parse($request->begin_at)->format('Y-m-d H:i:s');
        $data['received_at'] = Carbon::parse($request->received_at)->format('Y-m-d H:i:s');
        if($projectId = $this->_model->create($data)->id){
            $project = $this->_model::find($projectId);
            $project->members()->attach($request->group_member); 
            $project->status()->attach($request->group_status); 
            return redirect()->route('admin.project.index',['type' => $request->type])->with('success', 'Thêm dự án <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.project.index',['type' => $request->type])->with('error', 'Thêm dự án <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        $this->_data['item'] = $this->_model->findOrFail($id);
        return view('backend.project.edit',$this->_data);
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
        $data = $request->except('_token','_method','group_member','group_status');
        if($request->hasFile('file')){
            $this->validate($request,[
                    'file' => 'mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048',],          
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
        $data['ended_at'] = Carbon::parse($request->ended_at)->format('Y-m-d H:i:s');
        $data['estimated_at'] = Carbon::parse($request->estimated_at)->format('Y-m-d H:i:s');
        $data['begin_at'] = Carbon::parse($request->begin_at)->format('Y-m-d H:i:s');
        $data['received_at'] = Carbon::parse($request->received_at)->format('Y-m-d H:i:s');
        if($project->where('id', $id)->update($data)){
            $project->members()->sync($request->group_member); 
            $project->status()->sync($request->group_status); 
            return redirect()->route('admin.project.index',['type' => $request->type])->with('success', 'Sửa dự án <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.project.index',['type' => $request->type])->with('error', 'Sửa dự án <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            $data->members()->detach();
            $data->status()->detach();
            return ['success' => true, 'message' => 'Xóa dự án thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa dự án thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        $dataFile = $this->_model->whereIn('id',explode(",",$listId))->where('file','<>','')->pluck('file');
        $arrId = explode(",",$listId);
        foreach($dataFile as $file){
            File::delete(public_path('uploads/files/').$file);
        } 
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            DB::table('member_project')->whereIn('project_id',explode(",",$listId))->delete();
            DB::table('project_status')->whereIn('project_id',explode(",",$listId))->delete();
            return ['success' => true, 'message' => 'Xóa dự án thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa dự án thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
