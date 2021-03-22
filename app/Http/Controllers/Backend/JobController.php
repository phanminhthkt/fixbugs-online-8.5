<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(Job $job)
    {
        $this->_model = $job;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.job.index');
        $this->_data['table'] = 'jobs';
        $this->_data['title'] = 'Chức vụ';
    }

    public function index(Request $request)
    {
        $job  = $this->_model::where('id','<>', 0);
        if($request->has('term')){
            $job->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '?term='.$request->term;
        }
        $this->_data['items'] = $job->orderBy('id','desc')->paginate(10)->withPath(url()->current().$this->_pathType);
        return view('backend.job.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.job.add',$this->_data);
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
        if($this->_model->create($data)){
            return redirect()->route('admin.job.index')->with('success', 'Thêm chức vụ <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.job.index')->with('error', 'Thêm chức vụ <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        return view('backend.job.edit',$this->_data);
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
        $this->_model->findOrFail($id);
        $data = $request->except('_token','_method');//# request only
        if($this->_model->where('id', $id)->update($data)){
            return redirect()->route('admin.job.index')->with('success', 'Chỉnh sửa chức vụ <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.job.index')->with('error', 'Chỉnh sửa chức vụ <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        $this->_model->findOrFail($id);
        if($this->_model->where('id', $id)->delete()){
            return ['success' => true, 'message' => 'Xóa chức vụ thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa chức vụ thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            return ['success' => true, 'message' => 'Xóa chức vụ thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa chức vụ thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
