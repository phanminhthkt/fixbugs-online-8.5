<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required',
            'email' => 'required|email|unique:members,email',
            'username' => 'required|alpha_dash|unique:members,username',
            'password' => 'required|confirmed|min:6'
        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập Họ Tên',
            'email.required' => 'Vui lòng nhập Email',
            'email.email' => 'Không đúng định dạng Email',
            'email.unique' => 'Email này đã trùng, vui lòng chọn Email khác',
            'username.required' => 'Vui lòng nhập Tên đăng nhập',
            'username.alpha_dash' => 'Tên đăng nhập không được chứa các ký tự đặc biệt',
            'username.unique' => 'Tên đăng nhập này đã trùng, vui lòng chọn tên khác',
            'password.required' => 'Vui lòng nhập Mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất :min ký tự',
            'password.confirmed' => 'Confirm Mật khẩu không chính xác',
        ];
    }
}
