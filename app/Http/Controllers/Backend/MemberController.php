<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Job;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;

    public function __construct(Member $member)
    {
        $this->member = $member;
        $this->_pathType = '';
        $this->_data['table'] = 'members';
        $this->_data['jobs'] = Job::all();
        $this->_data['title'] = 'Thành viên';
    }

    public function index(Request $request)
    {
        $member  = Member::with(['job']);
        if($request->has('term')){
            $member->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '?term='.$request->term;
        }
        $this->_data['items'] = $member->orderBy('id','asc')->paginate(2)->withPath(url()->current().$this->_pathType);
        return view('backend.member.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.member.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignupRequest $request)
    {       
        $data = $request->except('_token','password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = $request->_token;
        if($this->member->create($data)){
            return redirect()->route('admin.member.index')->with('success', 'Thêm thành viên <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.member.index')->with('error', 'Thêm thành viên <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        $this->_data['item'] = $this->member->findOrFail($id);
        return view('backend.member.edit',$this->_data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SignupRequest $request, $id)
    {
        $this->member->findOrFail($id);
        
        $data = $request->except('_token','_method','password_confirmation');//# request only
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = $request->_token;
        if($this->member->where('id', $id)->update($data)){
            return redirect()->route('admin.member.index')->with('success', 'Chỉnh sửa thành viên <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.member.index')->with('error', 'Chỉnh sửa thành viên <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        $this->member->findOrFail($id);
        if($this->member->where('id', $id)->delete()){
            return ['success' => true, 'message' => 'Xóa thành viên thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa thành viên thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
