<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;//user model can kiem tra
use App\Models\Job;
use Illuminate\Support\Str;
use Auth; //use thư viện auth
use Session;


class MemberController extends Controller
{
    private $_data;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function index()
    {
        return view('frontend.member.index');//return ra trang login để đăng nhập
    }
    public function getLogin()
    {
        return view('frontend.member.login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $credentials  = [
            'email' =>[ 'email' => $request->email,'password' => $request->password],
            'user' =>[ 'username' => $request->email,'password' => $request->password]
        ];

        if($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }

        if (Auth::guard('members')->attempt($credentials['email']) || Auth::guard('members')->attempt($credentials['user'])){
            $user = Auth::guard('members')->user();
            // if(Session::has('loginMember')){Session::forget('loginMember');}
            session::put('loginMember',[
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'name' => $user->name,
                'is_job' => $user->is_job,
                'is_login' => true,
            ]);

            $is_job = $user->is_job; 
            $returnRoute = ($is_job == 0) ? 'frontend.show.job':'frontend.member.index';
            return redirect()->route($returnRoute);
        }else{
            return redirect()->route('frontend.member.login')->with('error', 'Thông tin đăng nhập sai');
        }
    }
    public function getRegister()
    {
        return view('frontend.member.register');//return ra trang login để đăng nhập
    }
    public function postRegister(SignupRequest $request)
    {
        // $member  = new Member;
        // if($member::create(
        if($this->member->create(
            [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10)
            ]
            )){
            return redirect()->route('frontend.show.login')->with('success', htmlspecialchars('Thêm thành viên '. $request->name .' thành công'));
        }else{
            return redirect()->route('frontend.member.login')->with('error', htmlspecialchars('Thêm thành viên '. $request->name .' thất bại.Xin vui lòng thử lại'));
        }
    }

    public function getJob()
    {
        $dataJob = Job::all();
        return view('frontend.member.job', compact('dataJob'));
    }
    public function updateMember(Request $requset,$id)
    {
        $this->member->findOrFail($id);
        $this->member->where('is_active', 1)->where('id', $id)->update(['is_job' => $requset->is_job]);
        Session::put('loginMember.is_job',$requset->is_job);
        return view('frontend.member.index');
    }
}
