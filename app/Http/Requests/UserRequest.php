<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            //'required|regex:/^[a-z0-9A-Z_-]{2,10}$/'.($this->route('id') ? '' : '|unique:roles'),
            'account' => 'required | max:191 |regex:/^[a-z0-9A-Z_-]{2,100}$/|unique:users,account'.$this->id,
            'password' => 'required | max:191 ',
            'full_name' => 'required | max:191 ',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'role'  => 'required',
            'phone'  => 'required',
            'status'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'account.required' => 'Vui lòng nhập vào tên tài khoản',
            'account.unique' => 'Tên tài khoản không thể trùng lặp',
            'account.max' => 'Tên tài khoản vượt quá số ký tự cho phép',
            'account.regex'       => 'Tên tài khoản không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu đăng nhập',
            'full_name.required' => 'Vui lòng nhập họ và tên',
            'status.required' => 'Vui lòng chọn trạng thái người dùng',
            'role.required' => 'Vui lòng chọn vai trò của người dùng',
            'email.required' => 'Vui lòng nhập vào email',
            'email.email' => 'Vui lòng nhập vào email đúng định dạng',
            'email.unique' => 'Địa chỉ email đã bị trùng',
            'phone.required' => 'Vui lòng nhập vào số điện thoại',
        ];
    }
}
