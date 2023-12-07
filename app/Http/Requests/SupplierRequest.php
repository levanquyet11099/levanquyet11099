<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            's_name' => 'required | max:255 ',
            's_code' => 'required| max:15 | unique:supplier,s_code,'.$this->id,
            's_email' => 'required| email| unique:supplier,s_email,'.$this->id,
            's_phone' => 'required | max:10 ',
            's_fax' => 'nullable | max:15 ',
            's_website' => 'nullable | max:255 ',
            's_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            's_name.required' => 'Vui lòng nhập vào tên nhà cung cấp',
            's_name.max' => 'Tên nhà cung cấp vượt quá số ký tự cho phép',
            's_code.required' => 'Vui lòng nhập vào mã nhà cung cấp',
            's_code.max' => 'Mã nhà cung cấp vượt quá số ký tự cho phép',
            's_code.unique' => 'Mã nhà cung cấp đã bị trùng',
            's_email.required' => 'Vui lòng nhập vào email',
            's_email.email' => 'Vui lòng nhập vào email đúng định dạng',
            's_email.unique' => 'Địa chỉ email đã bị trùng',
            's_phone.required' => 'Vui lòng nhập vào số điện thoại',
            's_phone.max' => 'Số điện thoại vượt quá số ký tự cho phép',
            's_fax.max' => 'Fax vượt quá số ký tự cho phép',
            's_website.max' => 'Website vượt quá số ký tự cho phép',
            's_status.required' => 'Vui lòng chọn trạng thái nhà cung cấp',
        ];
    }
}
