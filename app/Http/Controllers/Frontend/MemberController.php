<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;//user model can kiem tra
use App\Models\GroupMember;
use Illuminate\Support\Str;
use Auth; //use thư viện auth
use Session;


class MemberController extends Controller
{
    private $_data;
    private $_model;

    public function __construct(Member $member)
    {
        $this->_model = $member;
    }

    public function index()
    {
        return view('frontend.member.index');//return ra trang login để đăng nhập
    }
    public function getLogin()
    {
        session(['url.intended' => url()->previous()]);
        if(Auth::guard('members')->check() == true){
            return redirect()->intended(Session::get('url.intended'));
        }
        return view('frontend.member.login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $credentials  = [
            'email' =>[ 'email' => $request->email,'password' => $request->password],
            'user' =>[ 'username' => $request->email,'password' => $request->password]
        ];
        $remember = $request->remember == trans('remember.Remember Me') ? true : false;
        

        if (Auth::guard('members')->attempt($credentials['email']) || Auth::guard('members')->attempt($credentials['user'])){
            $user = Auth::guard('members')->user();
            if(Session::has('loginMember')){Session::forget('loginMember');}
            if($user->is_status == 0){
                Auth::guard('members')->logout();
                return redirect()->route('client.member.login')->with('danger', 'Tài khoản chưa kích hoạt');
            }
            session::put('loginMember',(object)[
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'name' => $user->name,
                'is_login' => true,
            ]);
            return redirect()->route('client.index');
        }else{
            return redirect()->route('client.member.login')->with('danger', 'Thông tin đăng nhập sai');
        }
    }
    public function getRegister()
    {
        session(['url.intended' => url()->previous()]);
        if(Auth::guard('members')->check() == true){
            return redirect()->intended(Session::get('url.intended'));
        }
        $data['groups'] = GroupMember::all();
        return view('frontend.member.register', $data);
    }
    public function postRegister(SignupRequest $request)
    {   
        $data = $request->except('_token','password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = $request->_token;

        if($this->_model->create($data)){
            return redirect()->route('client.member.login')->with('success', htmlspecialchars('Thêm thành viên '. $request->name .' thành công'));
        }else{
            return redirect()->route('client.member.login')->with('danger', htmlspecialchars('Thêm thành viên '. $request->name .' thất bại.Xin vui lòng thử lại'));
        }
    }

    public function logout(Request $request){
        Auth::guard('members')->logout();
        $request->session()->forget('loginMember');
        return redirect()->route('client.member.login');
    }
}
