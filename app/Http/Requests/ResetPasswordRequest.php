<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            //
            'password' => ['required'],
            'r_password' => ['required', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Vui lòng nhập vào mật khẩu mới',
            'r_password.required' => 'Vui lòng nhập lại mật khẩu',
            'r_password.same' => 'Mật khẩu không trùng khớp',

        ];
    }
}
