<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateInforProfileRequest extends FormRequest
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
            'full_name' => ['required'],
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Vui lòng nhập vào họ và tên lót',
            'last_name.required' => 'Vui lòng nhập vào tên',
            'email.required' => 'Vui lòng nhập vào email',
            'email.email' => 'Định dạng email không chính xác',
            'email.unique' => 'Địa chỉ email đã bị trùng',
            'phone.required' => 'Vui lòng nhập vào số điện thoại',
            'landline_telephone.required' => 'Vui lòng nhập vào số nội bộ',
            'department_id.required' => 'Vui lòng chọn phòng ban trực thuộc hiện tại',
        ];
    }
}
